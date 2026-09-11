#!/usr/bin/env bash
# ==============================================================================
#  Sistema NCIE · operación diaria del despliegue (envoltorio de docker compose)
#
#    bash deploy/ncie.sh up                 arranca todos los servicios
#    bash deploy/ncie.sh down               los detiene (los datos se conservan)
#    bash deploy/ncie.sh restart [servicio] reinicia
#    bash deploy/ncie.sh ps                 estado de los contenedores
#    bash deploy/ncie.sh logs [servicio]    registros en vivo (app, nginx, db, caddy)
#    bash deploy/ncie.sh artisan <args>     php artisan dentro del contenedor
#    bash deploy/ncie.sh shell              consola sh en el contenedor app
#    bash deploy/ncie.sh psql               consola de PostgreSQL
#    bash deploy/ncie.sh backup             respaldo comprimido en deploy/backups/
#    bash deploy/ncie.sh restore ARCHIVO    restaura un respaldo (reemplaza la BD)
#    bash deploy/ncie.sh demo               siembra los datos de demostración
#    bash deploy/ncie.sh update             re-despliega tras copiar código nuevo
#    bash deploy/ncie.sh check              verifica que la aplicación responde
#    bash deploy/ncie.sh compose <args>     docker compose con la configuración de producción
# ==============================================================================
set -Eeuo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# shellcheck source=lib.sh
source "$SCRIPT_DIR/lib.sh"

usage() { sed -n '3,19p' "$0" | sed 's/^# \{0,2\}//'; }

cmd="${1:-help}"; [[ $# -gt 0 ]] && shift

case "$cmd" in
  help|-h|--help) usage; exit 0 ;;
  update) exec bash "$SCRIPT_DIR/deploy.sh" --update "$@" ;;
  check)  exec bash "$SCRIPT_DIR/deploy.sh" --check "$@" ;;
esac

[[ -f "$ENV_FILE" ]] || die "No existe .env: ejecuta primero deploy/deploy.sh"
if [[ -n "$(env_get NCIE_DOMAIN)" ]]; then
  export COMPOSE_PROFILES=tls
  # Caddy no arranca con el correo ACME vacío
  [[ -n "$(env_get NCIE_ACME_EMAIL)" ]] || env_set NCIE_ACME_EMAIL "admin@$(env_get NCIE_DOMAIN)"
fi
DB_USER="$(env_get DB_USERNAME)"; DB_USER="${DB_USER:-ncie}"
DB_NAME="$(env_get DB_DATABASE)"; DB_NAME="${DB_NAME:-ncie}"

case "$cmd" in
  up)        compose up -d --wait --wait-timeout 120 && ok "Servicios en marcha" ;;
  down)      compose down && ok "Servicios detenidos (datos conservados)" ;;
  restart)   compose restart "$@" && ok "Reiniciado" ;;
  ps|status) compose ps ;;
  logs)      compose logs -f --tail=200 "$@" ;;
  artisan)   artisan_i "$@" ;;
  shell)     compose exec app sh ;;
  psql)      compose exec db psql -U "$DB_USER" -d "$DB_NAME" ;;
  compose)   compose "$@" ;;
  demo)
    confirm "DemoSeeder BORRA los datos del dominio y todos los usuarios que no sean admin. ¿Continuar?" || die "Cancelado"
    artisan db:seed --class=DemoSeeder --force && ok "Datos de demostración sembrados" ;;
  backup)
    mkdir -p "$SCRIPT_DIR/backups"
    f="$SCRIPT_DIR/backups/ncie-$(date +%Y%m%d-%H%M%S).sql.gz"
    compose exec -T db pg_dump -U "$DB_USER" -d "$DB_NAME" --no-owner --no-privileges | gzip > "$f"
    [[ -s "$f" ]] || die "El respaldo quedó vacío"
    ok "Respaldo guardado en $f ($(du -h "$f" | cut -f1))"
    say "   Las fotos de proyectos viven en public/uploads/fotos/: respáldalas aparte." ;;
  restore)
    f="${1:-}"; [[ -f "$f" ]] || die "Indica el archivo .sql.gz a restaurar"
    confirm "Se REEMPLAZARÁ la base de datos $DB_NAME con $f. ¿Continuar?" || die "Cancelado"
    artisan down --retry=30 >/dev/null 2>&1 || true
    compose exec -T db psql -U "$DB_USER" -d "$DB_NAME" -v ON_ERROR_STOP=1 -q \
      -c 'DROP SCHEMA public CASCADE; CREATE SCHEMA public;'
    gunzip -c "$f" | compose exec -T db psql -U "$DB_USER" -d "$DB_NAME" -v ON_ERROR_STOP=1 -q
    artisan permission:cache-reset >/dev/null 2>&1 || true
    artisan up >/dev/null 2>&1 || true
    ok "Base de datos restaurada desde $f" ;;
  *) die "Comando desconocido: $cmd  (usa: bash deploy/ncie.sh help)" ;;
esac
