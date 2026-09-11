#!/usr/bin/env bash
# ==============================================================================
#  Sistema NCIE · Despliegue en un servidor nuevo con Docker Compose
#
#  Instalar (HTTP en el puerto 80, acceso por IP o nombre):
#      sudo bash deploy/deploy.sh --url http://203.0.113.10
#  Instalar con dominio y HTTPS automático (Let's Encrypt mediante Caddy):
#      sudo bash deploy/deploy.sh --domain ncie.itcj.edu.mx --email sistemas@itcj.edu.mx
#  Actualizar después de copiar código nuevo al servidor:
#      sudo bash deploy/deploy.sh --update
#  Comprobar que todo responde:
#      bash deploy/deploy.sh --check
#
#  Opciones: --url URL  --domain DOMINIO  --email CORREO  --port PUERTO
#            --demo (datos de demostración)  --no-assets  --with-dev
#            --update  --check  --fresh (borra la base de datos)  --yes  --help
#
#  El script es idempotente: ejecutarlo varias veces no rompe nada. Cada
#  corrida deja un registro en deploy/logs/. Operación diaria: deploy/ncie.sh
# ==============================================================================
set -Eeuo pipefail

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
# shellcheck source=lib.sh
source "$SCRIPT_DIR/lib.sh"

# ----------------------------------------------------------------------------
# Opciones
# ----------------------------------------------------------------------------
MODE=install            # install | update | check | fresh
APP_URL_OPT=""; DOMAIN=""; ACME_EMAIL=""; HTTP_PORT=""
SEED_DEMO=0; BUILD_ASSETS=1; WITH_DEV=0; ASSUME_YES=0

usage() { sed -n '3,20p' "$0" | sed 's/^# \{0,2\}//'; }

while [[ $# -gt 0 ]]; do
  case "$1" in
    --url)        APP_URL_OPT="$2"; shift 2 ;;
    --url=*)      APP_URL_OPT="${1#*=}"; shift ;;
    --domain)     DOMAIN="$2"; shift 2 ;;
    --domain=*)   DOMAIN="${1#*=}"; shift ;;
    --email)      ACME_EMAIL="$2"; shift 2 ;;
    --email=*)    ACME_EMAIL="${1#*=}"; shift ;;
    --port)       HTTP_PORT="$2"; shift 2 ;;
    --port=*)     HTTP_PORT="${1#*=}"; shift ;;
    --demo)       SEED_DEMO=1; shift ;;
    --no-assets)  BUILD_ASSETS=0; shift ;;
    --with-dev)   WITH_DEV=1; shift ;;
    --update)     MODE=update; shift ;;
    --check)      MODE=check; shift ;;
    --fresh)      MODE=fresh; shift ;;
    -y|--yes)     ASSUME_YES=1; shift ;;
    -h|--help)    usage; exit 0 ;;
    *) die "Opción desconocida: $1  (usa --help)" ;;
  esac
done
export ASSUME_YES

[[ -n "$DOMAIN" && -n "$HTTP_PORT" && "$HTTP_PORT" == 80 ]] && die "Con --domain el puerto 80 lo usa Caddy; no indiques --port 80."
[[ -n "$DOMAIN" && -n "$APP_URL_OPT" ]] && warn "Se indicó --domain y --url; APP_URL será https://$DOMAIN"
if [[ -n "$DOMAIN" ]] && ! [[ "$DOMAIN" =~ ^[A-Za-z0-9.-]+\.[A-Za-z]{2,}$ ]]; then
  die "El dominio «$DOMAIN» no parece válido (ejemplo: ncie.itcj.edu.mx)"
fi
if [[ -n "$HTTP_PORT" ]] && ! [[ "$HTTP_PORT" =~ ^[0-9]{1,5}$ ]]; then
  die "El puerto «$HTTP_PORT» no es válido"
fi

# ----------------------------------------------------------------------------
# Registro de la corrida y manejo de errores
# ----------------------------------------------------------------------------
mkdir -p "$SCRIPT_DIR/logs"
LOG_FILE="$SCRIPT_DIR/logs/deploy-$(date +%Y%m%d-%H%M%S).log"
if command -v perl >/dev/null 2>&1; then
  exec > >(tee >(perl -pe 's/\e\[[0-9;]*m//g' >> "$LOG_FILE")) 2>&1
else
  exec > >(tee -a "$LOG_FILE") 2>&1
fi

CURRENT_STEP="inicio"
MAINTENANCE_ON=0
on_error() {
  local rc=$?
  {
    printf '\n%s   ERROR  Falló el paso «%s» (código %s).%s\n' "$C_RED" "$CURRENT_STEP" "$rc" "$C_RESET"
    say "   Registro completo:  $LOG_FILE"
    say "   Estado:             bash deploy/ncie.sh ps"
    say "   Registros:          bash deploy/ncie.sh logs"
    if [[ "$MAINTENANCE_ON" == 1 ]]; then
      warn "La aplicación quedó en modo mantenimiento. Al corregir el problema: bash deploy/ncie.sh artisan up"
    fi
  } >&2
  exit "$rc"
}
trap on_error ERR
step() { CURRENT_STEP="$1"; printf '\n%s==> %s%s\n' "$C_BOLD" "$1" "$C_RESET"; }

OS="$(uname -s)"
IS_LINUX=0; [[ "$OS" == Linux ]] && IS_LINUX=1

say "${C_BOLD}Sistema NCIE · despliegue ($MODE)${C_RESET}"
say "   Proyecto:  $ROOT"
say "   Compose:   $PROJECT_NAME  ($COMPOSE_FILE)"
say "   Registro:  $LOG_FILE"

# ----------------------------------------------------------------------------
# Pasos
# ----------------------------------------------------------------------------
check_docker() {
  step "Comprobando Docker"
  if ! command -v docker >/dev/null 2>&1; then
    [[ $IS_LINUX == 1 ]] || die "Docker no está instalado. En macOS o Windows instala Docker Desktop y vuelve a ejecutar."
    [[ $EUID -eq 0 ]] || die "Docker no está instalado. Ejecuta el script con sudo para instalarlo."
    confirm "Docker no está instalado. ¿Instalarlo ahora con el script oficial (get.docker.com)?" \
      || die "Instala Docker (https://docs.docker.com/engine/install/) y vuelve a ejecutar."
    curl -fsSL https://get.docker.com -o /tmp/get-docker.sh
    sh /tmp/get-docker.sh
    rm -f /tmp/get-docker.sh
    ok "Docker instalado"
  fi
  if [[ $IS_LINUX == 1 ]] && command -v systemctl >/dev/null 2>&1; then
    systemctl enable --now docker >/dev/null 2>&1 || true
  fi
  if ! docker info >/dev/null 2>&1; then
    if [[ $IS_LINUX == 1 && $EUID -ne 0 ]]; then
      die "No se puede hablar con Docker. Ejecuta con sudo o agrega tu usuario al grupo docker (usermod -aG docker \$USER y vuelve a iniciar sesión)."
    fi
    die "El servicio de Docker no responde (docker info falló). En macOS abre Docker Desktop y espera ~30 s."
  fi
  docker compose version >/dev/null 2>&1 || die "Falta Docker Compose v2 (paquete docker-compose-plugin)."
  local ver major minor
  ver="$(docker compose version --short 2>/dev/null || echo 0.0)"; ver="${ver#v}"
  major="${ver%%.*}"; minor="${ver#*.}"; minor="${minor%%.*}"
  if [[ "$major" -lt 2 || ( "$major" -eq 2 && "$minor" -lt 20 ) ]]; then
    die "Docker Compose $ver es demasiado antiguo; se necesita 2.20 o superior."
  fi
  ok "Docker $(docker version --format '{{.Server.Version}}' 2>/dev/null || echo '?') · Compose $ver"
  if [[ $IS_LINUX == 1 && $EUID -eq 0 && -n "${SUDO_USER:-}" ]] && ! id -nG "$SUDO_USER" 2>/dev/null | grep -qw docker; then
    usermod -aG docker "$SUDO_USER" 2>/dev/null && info "Usuario $SUDO_USER añadido al grupo docker (aplica al volver a iniciar sesión)."
  fi
}

check_project() {
  step "Comprobando el proyecto"
  local f
  for f in artisan composer.json composer.lock package.json docker/php/Dockerfile .env.docker \
           deploy/docker-compose.prod.yml deploy/nginx.conf deploy/php.ini deploy/Caddyfile; do
    [[ -f "$ROOT/$f" ]] || die "Falta $f en $ROOT. ¿Copiaste el proyecto completo?"
  done
  ok "Archivos del proyecto presentes"

  local free_kb
  free_kb="$( { df -Pk "$ROOT" 2>/dev/null || true; } | awk 'NR==2 {print $4}')"
  if [[ -n "$free_kb" && "$free_kb" -lt $((2 * 1024 * 1024)) ]]; then
    warn "Quedan menos de 2 GB libres en el disco de $ROOT."
  fi
  if [[ $IS_LINUX == 1 && -r /proc/meminfo ]]; then
    local mem_kb
    mem_kb="$(awk '/MemTotal/ {print $2}' /proc/meminfo || true)"
    [[ -n "$mem_kb" && "$mem_kb" -lt $((1536 * 1024)) ]] && warn "El servidor tiene menos de 1.5 GB de RAM; la compilación de assets puede ser lenta."
  fi
}

check_port_free() {
  # Aborta si otro proceso (ajeno a este despliegue) ya escucha en el puerto.
  local port="$1" listener=""
  if command -v ss >/dev/null 2>&1; then
    listener="$( { ss -Hltn "sport = :$port" 2>/dev/null || true; } | head -n 1)"
  elif command -v lsof >/dev/null 2>&1; then
    listener="$( { lsof -nP -iTCP:"$port" -sTCP:LISTEN 2>/dev/null || true; } | tail -n +2 | head -n 1)"
  fi
  [[ -z "$listener" ]] && return 0
  if docker ps --filter "label=com.docker.compose.project=$PROJECT_NAME" --format '{{.Ports}}' 2>/dev/null | grep -q ":${port}->"; then
    return 0   # es nuestro propio contenedor
  fi
  die "El puerto $port ya está en uso por otro proceso: $listener  (usa --port para elegir otro)"
}

prepare_env() {
  step "Preparando el archivo .env"
  local created=0
  if [[ ! -f "$ENV_FILE" ]]; then
    if docker volume inspect "${PROJECT_NAME}_pgdata" >/dev/null 2>&1 && [[ "$MODE" != fresh ]]; then
      die "No existe .env pero sí una base de datos previa (volumen ${PROJECT_NAME}_pgdata). Restaura el .env original (con su DB_PASSWORD) o empieza de cero con --fresh."
    fi
    cp "$ROOT/.env.docker" "$ENV_FILE"
    env_set APP_ENV production
    env_set APP_DEBUG false
    env_set LOG_LEVEL warning
    env_set APP_KEY ""
    env_set DB_PASSWORD "$(gen_secret)"
    created=1
    ok ".env creado desde .env.docker (APP_ENV=production, APP_DEBUG=false, contraseña de BD nueva)"
  else
    ok ".env existente; se conserva"
  fi
  if [[ -z "$(env_get DB_PASSWORD)" ]]; then
    env_set DB_PASSWORD "$(gen_secret)"
    warn "DB_PASSWORD estaba vacío; se generó uno nuevo"
  fi
  [[ -n "$(env_get DB_DATABASE)" ]] || env_set DB_DATABASE ncie
  [[ -n "$(env_get DB_USERNAME)" ]] || env_set DB_USERNAME ncie
  env_set DB_CONNECTION pgsql
  env_set DB_HOST db
  env_set DB_PORT 5432

  if [[ -n "$DOMAIN" ]]; then
    env_set NCIE_DOMAIN "$DOMAIN"
    env_set NCIE_ACME_EMAIL "${ACME_EMAIL:-$(env_get NCIE_ACME_EMAIL)}"
    [[ -n "$(env_get NCIE_ACME_EMAIL)" ]] || { env_set NCIE_ACME_EMAIL "admin@$DOMAIN"; warn "Sin --email; se usará admin@$DOMAIN para Let's Encrypt"; }
    env_set NCIE_HTTP_BIND 127.0.0.1
    env_set NCIE_HTTP_PORT "${HTTP_PORT:-8080}"
    env_set APP_URL "https://$DOMAIN"
  else
    [[ -n "$HTTP_PORT" ]] && env_set NCIE_HTTP_PORT "$HTTP_PORT"
    [[ -n "$(env_get NCIE_HTTP_PORT)" ]] || env_set NCIE_HTTP_PORT 80
    if [[ -z "$(env_get NCIE_DOMAIN)" ]]; then
      env_set NCIE_HTTP_BIND 0.0.0.0
    fi
    if [[ -n "$APP_URL_OPT" ]]; then
      env_set APP_URL "$APP_URL_OPT"
    elif [[ $created == 1 ]]; then
      local ip port url
      ip="$( { hostname -I 2>/dev/null || true; } | awk '{print $1}')"
      port="$(env_get NCIE_HTTP_PORT)"
      url="http://${ip:-localhost}"; [[ "$port" != 80 ]] && url="$url:$port"
      env_set APP_URL "$url"
      warn "No se indicó --url; APP_URL=$url (cámbialo con --url si el acceso será por otro nombre)"
    fi
  fi

  TLS=0; [[ -n "$(env_get NCIE_DOMAIN)" ]] && TLS=1
  if [[ $TLS == 1 ]]; then export COMPOSE_PROFILES=tls; fi
  HTTP_PORT_EFF="$(env_get NCIE_HTTP_PORT)"

  # El usuario que ejecutó sudo debe poder editar el .env sin privilegios
  if [[ -n "${SUDO_USER:-}" ]]; then chown "$SUDO_USER" "$ENV_FILE" "$LOG_FILE" "$SCRIPT_DIR/logs" 2>/dev/null || true; fi
  ok "APP_URL=$(env_get APP_URL) · puerto HTTP $HTTP_PORT_EFF · HTTPS $([[ $TLS == 1 ]] && echo "sí ($(env_get NCIE_DOMAIN))" || echo no)"
}

prepare_dirs() {
  step "Directorios y permisos base"
  mkdir -p "$ROOT"/storage/app/public "$ROOT"/storage/framework/cache/data "$ROOT"/storage/framework/sessions \
           "$ROOT"/storage/framework/testing "$ROOT"/storage/framework/views "$ROOT"/storage/logs \
           "$ROOT"/bootstrap/cache "$ROOT"/public/uploads/fotos
  rm -f "$ROOT/public/hot"
  # Lectura para todos (PHP-FPM corre como www-data); la escritura se ajusta después dentro del contenedor
  chmod -R a+rX "$ROOT" 2>/dev/null || true
  ok "storage/, bootstrap/cache/ y public/uploads/ listos"
}

start_database() {
  step "Construyendo la imagen de PHP y arrancando PostgreSQL"
  compose build app
  compose up -d --wait --wait-timeout 180 db
  ok "PostgreSQL saludable"
}

start_app() {
  step "Arrancando PHP-FPM"
  compose up -d app
  ok "Contenedor app en marcha"
}

maintenance_on() {
  step "Activando modo mantenimiento"
  if artisan down --retry=30 >/dev/null 2>&1; then MAINTENANCE_ON=1; ok "Página de mantenimiento activa"; else warn "No se pudo activar el modo mantenimiento (se continúa)"; fi
}

maintenance_off() {
  if [[ "$MAINTENANCE_ON" == 1 ]]; then artisan up >/dev/null; MAINTENANCE_ON=0; ok "Modo mantenimiento desactivado"; fi
}

install_php_deps() {
  step "Instalando dependencias de PHP (Composer)"
  local flags=(--prefer-dist --no-interaction --no-progress --optimize-autoloader)
  [[ $WITH_DEV == 1 ]] || flags+=(--no-dev)
  compose exec -T app composer install "${flags[@]}"
  ok "vendor/ actualizado"
}

app_key() {
  step "Clave de la aplicación"
  if [[ -z "$(env_get APP_KEY)" ]]; then
    artisan key:generate --force
    ok "APP_KEY generada"
  else
    ok "APP_KEY ya definida"
  fi
}

migrate_and_seed() {
  step "Migrando la base de datos"
  artisan optimize:clear >/dev/null 2>&1 || true
  artisan migrate --force
  local roles
  roles="$(compose exec -T db psql -U "$(env_get DB_USERNAME)" -d "$(env_get DB_DATABASE)" -tAc 'select count(*) from roles' | tr -d '[:space:]')" \
    || die "No se pudo consultar la tabla roles en PostgreSQL"
  if [[ "$roles" == "0" ]]; then
    artisan db:seed --force
    ok "Roles, permisos y usuario administrador sembrados"
  else
    ok "Roles ya presentes ($roles); no se vuelven a sembrar"
  fi
  if [[ $SEED_DEMO == 1 ]]; then
    confirm "DemoSeeder BORRA los datos del dominio y todos los usuarios que no sean admin. ¿Sembrar datos de demostración?" \
      || die "Cancelado por el usuario"
    artisan db:seed --class=DemoSeeder --force
    ok "Datos de demostración sembrados"
  fi
}

build_assets() {
  if [[ $BUILD_ASSETS == 0 ]]; then
    [[ -f "$ROOT/public/build/manifest.json" ]] || warn "Sin --no-assets no habría pasado: falta public/build/manifest.json"
    return 0
  fi
  step "Compilando assets con Vite (npm)"
  compose --profile assets run --rm node
  [[ -f "$ROOT/public/build/manifest.json" ]] || die "No se generó public/build/manifest.json"
  ok "public/build/ generado"
}

fix_permissions() {
  step "Permisos de escritura para PHP-FPM (www-data)"
  compose exec -T app sh -c '
    chown -R www-data:www-data storage bootstrap/cache public/uploads &&
    chmod -R ug+rwX storage bootstrap/cache public/uploads &&
    chgrp www-data .env && chmod 640 .env
  '
  ok "storage/, bootstrap/cache/, public/uploads/ escribibles; .env solo legible por el propietario y www-data"
}

optimize() {
  step "Optimizando (caché de configuración, rutas y vistas)"
  artisan config:cache
  if ! artisan route:cache; then
    warn "route:cache falló; la aplicación funciona igual sin caché de rutas"
    artisan route:clear || true
  fi
  artisan view:cache
  compose restart app >/dev/null
  ok "Cachés generadas y PHP-FPM reiniciado"
}

start_web() {
  step "Arrancando el servidor web$([[ $TLS == 1 ]] && echo ' y Caddy (HTTPS)')"
  compose up -d --wait --wait-timeout 120
  ok "Servicios en marcha"
}

open_firewall() {
  [[ $IS_LINUX == 1 ]] || return 0
  command -v ufw >/dev/null 2>&1 || return 0
  ufw status 2>/dev/null | grep -q '^Status: active' || return 0
  step "Cortafuegos (ufw activo)"
  local p
  if [[ $TLS == 1 ]]; then
    for p in 80 443; do ufw allow "$p/tcp" >/dev/null && ok "ufw: puerto $p abierto"; done
  else
    ufw allow "$HTTP_PORT_EFF/tcp" >/dev/null && ok "ufw: puerto $HTTP_PORT_EFF abierto"
  fi
}

check_url() {
  # check_url URL "códigos aceptados"
  local code
  code="$(curl -s -o /dev/null -w '%{http_code}' --max-time 20 "$1" 2>/dev/null || echo 000)"
  if [[ " $2 " == *" $code "* ]]; then ok "$1 → $code"; return 0; fi
  warn "$1 → $code (esperado: $2)"; return 1
}

health_check() {
  step "Verificando que la aplicación responde"
  local base="http://127.0.0.1:${HTTP_PORT_EFF}" i good=0
  for i in 1 2 3 4 5 6 7 8 9 10; do
    if check_url "$base/" "200" && check_url "$base/login" "200" && check_url "$base/admin" "302"; then good=1; break; fi
    [[ $i -lt 10 ]] && { info "Reintentando en 5 s ($i/10)…"; sleep 5; }
  done
  [[ $good == 1 ]] || die "La aplicación no responde como se esperaba. Revisa: bash deploy/ncie.sh logs app nginx"
  if [[ $TLS == 1 ]]; then
    local d; d="$(env_get NCIE_DOMAIN)"
    if ! check_url "https://$d/" "200 301 302"; then
      warn "HTTPS aún no responde. Caddy pide el certificado en cuanto el DNS de $d apunte a este servidor y los puertos 80/443 estén abiertos; revisa: bash deploy/ncie.sh logs caddy"
    fi
  fi
  artisan about --only=environment 2>/dev/null | sed -n '1,12p' || true
}

summary() {
  step "Resumen"
  local url; url="$(env_get APP_URL)"
  say "   Sitio público:       $url"
  say "   Inicio de sesión:    $url/login"
  say "   Administrador:       sistemancie@gmail.com (contraseña inicial en README.md; cámbiala en el primer acceso)"
  say "   Correo saliente:     MAIL_MAILER=$(env_get MAIL_MAILER) (para SMTP real edita MAIL_* en .env y ejecuta: bash deploy/ncie.sh artisan config:cache)"
  say "   Operación diaria:    bash deploy/ncie.sh {up|down|ps|logs|artisan|backup|update|check}"
  say "   Registro:            $LOG_FILE"
}

# ----------------------------------------------------------------------------
# Flujo
# ----------------------------------------------------------------------------
case "$MODE" in
  check)
    check_docker
    [[ -f "$ENV_FILE" ]] || die "No existe .env: la aplicación no se ha desplegado aún."
    TLS=0; [[ -n "$(env_get NCIE_DOMAIN)" ]] && TLS=1 && export COMPOSE_PROFILES=tls
    HTTP_PORT_EFF="$(env_get NCIE_HTTP_PORT)"; [[ -n "$HTTP_PORT_EFF" ]] || HTTP_PORT_EFF=80
    compose ps
    health_check
    ;;
  fresh)
    check_docker
    check_project
    confirm "--fresh BORRA la base de datos (volumen ${PROJECT_NAME}_pgdata) y los contenedores. ¿Continuar?" || die "Cancelado"
    compose down -v --remove-orphans 2>/dev/null || docker volume rm "${PROJECT_NAME}_pgdata" 2>/dev/null || true
    ok "Base de datos y contenedores eliminados"
    prepare_env; check_port_free "$HTTP_PORT_EFF"; [[ $TLS == 1 ]] && { check_port_free 80; check_port_free 443; }
    prepare_dirs; start_database; start_app; install_php_deps; app_key; migrate_and_seed
    build_assets; fix_permissions; optimize; start_web; open_firewall; health_check; summary
    ;;
  update)
    check_docker; check_project
    [[ -f "$ENV_FILE" ]] || die "No existe .env: ejecuta primero la instalación (sin --update)."
    prepare_env; prepare_dirs; start_database; start_app
    maintenance_on
    install_php_deps; app_key; migrate_and_seed; build_assets; fix_permissions; optimize; start_web
    maintenance_off
    open_firewall; health_check; summary
    ;;
  install)
    check_docker; check_project; prepare_env
    check_port_free "$HTTP_PORT_EFF"; [[ $TLS == 1 ]] && { check_port_free 80; check_port_free 443; }
    prepare_dirs; start_database; start_app; install_php_deps; app_key; migrate_and_seed
    build_assets; fix_permissions; optimize; start_web; open_firewall; health_check; summary
    ;;
esac

printf '\n%s   LISTO%s  Despliegue completado sin errores.\n' "$C_GREEN" "$C_RESET"
