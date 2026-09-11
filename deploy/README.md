# Despliegue del Sistema NCIE en un servidor

Esta carpeta contiene todo lo necesario para poner el sistema en marcha en un servidor Linux limpio (Ubuntu o Debian recomendados) usando Docker, sin instalar PHP, Composer, Node ni PostgreSQL en el servidor.

| Archivo | Para qué sirve |
|---|---|
| `deploy.sh` | Instala o actualiza el sistema completo. Idempotente: se puede ejecutar las veces que haga falta. |
| `ncie.sh` | Operación diaria: arrancar, detener, ver registros, `artisan`, respaldos, restaurar. |
| `docker-compose.prod.yml` | Servicios de producción (NGINX, PHP-FPM, PostgreSQL, Node para assets, Caddy opcional para HTTPS). |
| `nginx.conf` | NGINX con compresión, caché de recursos estáticos y cabeceras de seguridad. |
| `php.ini` | Límites de PHP y OPcache para producción. |
| `Caddyfile` | Proxy con certificados automáticos de Let's Encrypt (solo con `--domain`). |
| `rsync-exclude.txt` | Lo que no debe copiarse al servidor. |
| `lib.sh` | Funciones compartidas por los dos scripts. |
| `logs/`, `backups/` | Registros de cada despliegue y respaldos de la base de datos (no se versionan). |

## 1. Requisitos del servidor

- Linux de 64 bits con acceso `sudo` (Ubuntu 22.04 LTS o superior recomendado). Docker se instala solo si falta.
- 2 vCPU, 2 GB de RAM y 10 GB de disco libres como mínimo.
- Puerto 80 abierto (y 443 si se usará HTTPS). Si el servidor está detrás de un cortafuegos institucional, pedir que abran esos puertos hacia la IP del servidor.
- Para HTTPS automático: un nombre de dominio cuyo DNS apunte a la IP pública del servidor.

## 2. Copiar el proyecto al servidor

Desde la máquina de desarrollo, con `rsync` (respeta las exclusiones: no copia `vendor`, `node_modules`, `.env`, fotos subidas ni documentos internos):

```bash
rsync -avz --delete --exclude-from=deploy/rsync-exclude.txt ./ usuario@SERVIDOR:/opt/ncie/
```

O bien clonando el repositorio en el servidor:

```bash
git clone https://github.com/Joshua-Velasco/NCIEPortal.git /opt/ncie
```

## 3. Instalar

En el servidor, dentro de la carpeta del proyecto:

```bash
cd /opt/ncie

# Acceso por IP o nombre, HTTP en el puerto 80
sudo bash deploy/deploy.sh --url http://203.0.113.10

# Acceso por dominio con HTTPS automático (Let's Encrypt)
sudo bash deploy/deploy.sh --domain ncie.itcj.edu.mx --email sistemas@itcj.edu.mx

# Cualquiera de los dos, además con los datos de demostración
sudo bash deploy/deploy.sh --url http://203.0.113.10 --demo
```

Qué hace el script, en orden:

1. Comprueba Docker y Docker Compose (los instala en Linux si faltan) y que el proyecto esté completo.
2. Crea `.env` a partir de `.env.docker` con `APP_ENV=production`, `APP_DEBUG=false`, una contraseña nueva y aleatoria para PostgreSQL y la `APP_URL` indicada. Si `.env` ya existe, lo conserva.
3. Construye la imagen de PHP y arranca PostgreSQL esperando a que esté saludable.
4. Instala las dependencias de PHP (`composer install --no-dev`), genera `APP_KEY` si no existe y ejecuta las migraciones.
5. Siembra roles, permisos y el usuario administrador solo si la base de datos está vacía. Con `--demo` siembra también los datos de demostración.
6. Compila los assets con Vite dentro de un contenedor de Node.
7. Ajusta permisos: `storage/`, `bootstrap/cache/` y `public/uploads/` escribibles por PHP-FPM; `.env` legible solo por el propietario y PHP.
8. Genera las cachés de configuración, rutas y vistas, arranca NGINX (y Caddy si hay dominio) y abre el puerto en `ufw` si está activo.
9. Verifica que la portada, `/login` y `/admin` respondan como se espera y muestra un resumen.

Cada corrida deja su registro en `deploy/logs/`.

Opciones:

| Opción | Efecto |
|---|---|
| `--url URL` | `APP_URL` del sistema (por ejemplo `http://IP` o `http://IP:8080`). |
| `--domain DOMINIO` | Activa Caddy con HTTPS automático; `APP_URL` pasa a `https://DOMINIO`. |
| `--email CORREO` | Correo para los avisos de Let's Encrypt (con `--domain`). |
| `--port PUERTO` | Puerto HTTP que publica NGINX (80 por defecto; con `--domain`, NGINX queda interno en 8080). |
| `--demo` | Siembra los datos de demostración (borra los datos del dominio y los usuarios que no sean admin). |
| `--no-assets` | No compila los assets (si ya existe `public/build/`). |
| `--with-dev` | Instala también las dependencias de desarrollo de Composer (PHPUnit, Pint). |
| `--update` | Re-despliega tras copiar código nuevo, con página de mantenimiento mientras dura. |
| `--check` | Solo verifica que la aplicación responde. |
| `--fresh` | Borra la base de datos y vuelve a instalar desde cero. Pide confirmación. |
| `--yes` | No pregunta nada (para automatizar). |

## 4. Después de instalar

- Entrar en `APP_URL/login` con el administrador `sistemancie@gmail.com` (contraseña inicial en el `README.md` de la raíz) y **cambiar la contraseña** desde el panel.
- Correo saliente: por defecto `MAIL_MAILER=log` (los correos se escriben en `storage/logs/laravel.log`). Para enviar correo real, editar en `.env` las claves `MAIL_MAILER=smtp`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION` y `MAIL_FROM_ADDRESS`, y luego ejecutar `bash deploy/ncie.sh artisan config:cache`.
- Verificación de correo al registrarse: `NCIE_EMAIL_VERIFICATION=true` en `.env` (requiere correo saliente funcionando) y `config:cache`.
- Guardar una copia del `.env` del servidor en un lugar seguro: contiene `APP_KEY` y la contraseña de la base de datos, y sin ellos no se puede recuperar un respaldo.

## 5. Operación diaria

```bash
bash deploy/ncie.sh ps                # estado de los contenedores
bash deploy/ncie.sh logs app          # registros en vivo (app, nginx, db, caddy)
bash deploy/ncie.sh artisan tinker    # cualquier comando artisan
bash deploy/ncie.sh backup            # respaldo en deploy/backups/ncie-FECHA.sql.gz
bash deploy/ncie.sh restore deploy/backups/ncie-FECHA.sql.gz
bash deploy/ncie.sh down              # detener (los datos se conservan)
bash deploy/ncie.sh up                # arrancar
```

Los contenedores tienen `restart: always`: si el servidor se reinicia, vuelven solos en cuanto arranca Docker. Las fotos de proyectos se guardan en `public/uploads/fotos/`; respaldarlas aparte junto con el `.env`.

Respaldo automático diario (opcional), como `cron` del usuario que administra el servidor:

```
0 2 * * * cd /opt/ncie && bash deploy/ncie.sh backup >> deploy/logs/backup.log 2>&1
```

## 6. Actualizar el sistema

1. Hacer un respaldo: `bash deploy/ncie.sh backup`.
2. Copiar el código nuevo al servidor (mismo `rsync` de la sección 2, o `git pull`).
3. Ejecutar `sudo bash deploy/deploy.sh --update`. Activa la página de mantenimiento, instala dependencias, migra, recompila assets, regenera cachés y vuelve a abrir el sitio. Si algo falla, el sitio queda en mantenimiento y el registro indica el paso; al corregirlo, `bash deploy/ncie.sh artisan up`.

## 7. Problemas comunes

| Síntoma | Qué revisar |
|---|---|
| `docker info` falla | En Linux ejecutar el script con `sudo`; el servicio se habilita con `systemctl enable --now docker`. |
| «El puerto 80 ya está en uso» | Otro servidor web (Apache, otro NGINX) ocupa el puerto. Detenerlo o usar `--port 8080`. |
| La portada responde 500 | `bash deploy/ncie.sh logs app` y `storage/logs/laravel.log`. Suele ser `.env` incompleto o permisos: volver a ejecutar `deploy.sh`. |
| No carga el CSS del panel o de la portada | Son archivos estáticos en `public/`; comprobar que la copia incluyó `public/assets` y `public/dist`. |
| Las páginas que usan `@vite` fallan | Falta `public/build/`: ejecutar `deploy.sh` sin `--no-assets`. |
| HTTPS no responde | El DNS del dominio debe apuntar al servidor y los puertos 80 y 443 estar abiertos; `bash deploy/ncie.sh logs caddy`. |
| Los correos no llegan | Con `MAIL_MAILER=log` no se envían; configurar SMTP (sección 4). |
| Se perdió `.env` | Sin la contraseña de la base de datos no se puede abrir el volumen `pgdata`. Restaurar el `.env` guardado o reinstalar con `--fresh` y un respaldo. |
| Ver la base de datos | `bash deploy/ncie.sh psql`. El puerto 5432 no se publica fuera del servidor a propósito. |

## 8. Notas de arquitectura

- Los servicios se nombran `ncie-app-1`, `ncie-nginx-1`, `ncie-db-1` (proyecto Compose `ncie`). El `docker-compose.yml` de la raíz sigue siendo el de desarrollo y no se usa en el servidor.
- PHP-FPM ejecuta la aplicación como `www-data`; por eso el script asigna ese propietario a `storage/`, `bootstrap/cache/` y `public/uploads/`.
- Laravel confía en las cabeceras `X-Forwarded-*` de NGINX y Caddy (`app/Http/Middleware/TrustProxies.php`), que solo son alcanzables dentro de la red de Docker; así genera enlaces `https://` correctos detrás del proxy.
- La base de datos usa collation `es-MX` (ICU) para que el orden alfabético respete acentos y eñes.
