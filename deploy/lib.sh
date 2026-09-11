#!/usr/bin/env bash
# ------------------------------------------------------------------------------
#  Sistema NCIE · funciones compartidas por deploy.sh y ncie.sh
#  (no se ejecuta directamente; los otros scripts lo cargan con `source`)
# ------------------------------------------------------------------------------

DEPLOY_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
ROOT="$(cd "$DEPLOY_DIR/.." && pwd)"
COMPOSE_FILE="$DEPLOY_DIR/docker-compose.prod.yml"
ENV_FILE="$ROOT/.env"
# Nombre del proyecto de Compose (prefijo de contenedores, red y volúmenes).
# Se puede cambiar con la variable NCIE_PROJECT, por ejemplo para pruebas.
PROJECT_NAME="${NCIE_PROJECT:-ncie}"

# shellcheck disable=SC2034  # los colores los usan los scripts que cargan este archivo
if [[ -t 1 ]]; then
  C_RESET=$'\e[0m'; C_BOLD=$'\e[1m'; C_GREEN=$'\e[32m'; C_YELLOW=$'\e[33m'; C_RED=$'\e[31m'; C_BLUE=$'\e[34m'
else
  C_RESET=''; C_BOLD=''; C_GREEN=''; C_YELLOW=''; C_RED=''; C_BLUE=''
fi

say()  { printf '%s\n' "$*"; }
info() { printf '%s->%s %s\n' "$C_BLUE" "$C_RESET" "$*"; }
ok()   { printf '%s   OK%s  %s\n' "$C_GREEN" "$C_RESET" "$*"; }
warn() { printf '%s   AVISO  %s%s\n' "$C_YELLOW" "$*" "$C_RESET" >&2; }
die()  { printf '%s   ERROR  %s%s\n' "$C_RED" "$*" "$C_RESET" >&2; exit 1; }

# docker compose con el archivo de producción, la raíz del proyecto como
# directorio de trabajo y el .env de Laravel como fuente de variables.
compose() {
  docker compose \
    --project-name "$PROJECT_NAME" \
    --project-directory "$ROOT" \
    --env-file "$ENV_FILE" \
    -f "$COMPOSE_FILE" \
    "$@"
}

# artisan sin terminal (para scripts); artisan_i con terminal (tinker, etc.).
artisan()   { compose exec -T app php artisan "$@"; }
artisan_i() { compose exec    app php artisan "$@"; }

# Lee una clave del .env (quita comillas envolventes).
env_get() {
  local v
  v="$( { grep -E "^${1}=" "$ENV_FILE" 2>/dev/null || true; } | tail -n 1 | cut -d= -f2-)"
  v="${v%\"}"; v="${v#\"}"
  printf '%s' "$v"
}

# Crea o reemplaza una clave del .env conservando el resto del archivo.
env_set() {
  local key="$1" val="$2" tmp
  tmp="$(mktemp)"
  if grep -qE "^${key}=" "$ENV_FILE" 2>/dev/null; then
    awk -v k="$key" -v v="$val" '
      BEGIN { done = 0 }
      index($0, k "=") == 1 && !done { print k "=" v; done = 1; next }
      { print }
    ' "$ENV_FILE" > "$tmp"
  else
    cat "$ENV_FILE" > "$tmp"
    [[ -s "$tmp" && "$(tail -c 1 "$tmp" | od -An -c | tr -d ' ')" != '\n' ]] && printf '\n' >> "$tmp"
    printf '%s=%s\n' "$key" "$val" >> "$tmp"
  fi
  cat "$tmp" > "$ENV_FILE"
  rm -f "$tmp"
}

# Secreto aleatorio de 32 caracteres hexadecimales.
gen_secret() {
  if command -v openssl >/dev/null 2>&1; then
    openssl rand -hex 16
  else
    head -c 16 /dev/urandom | od -An -tx1 | tr -d ' \n'
  fi
}

# Pregunta sí/no. Con ASSUME_YES=1 responde sí; sin terminal, aborta.
confirm() {
  [[ "${ASSUME_YES:-0}" == 1 ]] && return 0
  if [[ ! -t 0 ]]; then
    die "Se necesita confirmar: $1  (vuelve a ejecutar con --yes)"
  fi
  local r
  read -r -p "$1 [s/N] " r
  [[ "$r" =~ ^[sSyY]$ ]]
}
