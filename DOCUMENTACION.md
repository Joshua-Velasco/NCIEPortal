# Sistema NCIE — Guía técnica

> Complementa a [INFO.md](INFO.md). Actualizada el 2026-09-11 para la versión 2.0.0. Este archivo no contiene contraseñas de servicios; las credenciales reales van solo en `.env`, que no se versiona.

---

## 1. Entorno vigente

El sistema se ejecuta en **Docker** con cuatro servicios definidos en `docker-compose.yml`:

| Servicio | Imagen | Puerto | Función |
|---|---|---|---|
| `nginx` | nginx:1.27-alpine | 8080 → 80 | Sirve `public/` y reenvía PHP a `app:9000` |
| `app` | build de `docker/php/Dockerfile` (php:8.2-fpm-alpine + pdo_pgsql, bcmath, zip, opcache, Composer 2) | 9000 interno | Laravel |
| `db` | postgres:16-alpine | 5432 | Base de datos `ncie`, usuario `ncie`, volumen `pgdata`, collation `es-MX` |
| `node` | node:20-alpine, perfil `assets` | — | `npm install && npm run build` bajo demanda |

Los tres servicios permanentes tienen `restart: unless-stopped`: al abrir Docker Desktop vuelven solos.

### Arranque diario

```bash
cd <ruta-del-proyecto>
docker compose up -d
```

Abrir http://localhost:8080. Los datos persisten en el volumen `pgdata`.

### Instalación desde cero

```bash
cd <ruta-del-proyecto>
cp .env.docker .env                                   # plantilla para Docker
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed    # esquema + roles + admin
docker compose exec app php artisan db:seed --class=DemoSeeder   # datos de demostración
docker compose --profile assets run --rm node         # assets de Vite (solo layouts app/app2)
docker compose exec app chmod -R ug+rw storage bootstrap/cache public/uploads
```

### Comandos útiles

```bash
docker compose logs -f nginx app db
docker compose exec app php artisan view:clear        # tras editar vistas Blade
docker compose exec app php artisan config:clear      # tras editar .env
docker compose exec app php artisan tinker
docker compose exec db psql -U ncie ncie
docker compose down                                   # apaga; conserva los datos
docker compose down -v                                # apaga y BORRA la base de datos
```

### Si Docker no levanta

Diagnóstico hecho en una Mac con 8 GB de RAM:

- Docker Desktop no arranca solo al iniciar sesión (`AutoStart` desactivado). Abrirlo con `open -a Docker` y esperar unos 30 segundos antes de `docker compose up -d`.
- Con poca memoria libre la máquina virtual de Docker tarda mucho o parece no arrancar. Cerrar aplicaciones pesadas antes, y bajar la memoria de la VM a 3 GB en Docker Desktop, Settings, Resources.
- Si `docker compose ps` muestra contenedores `Exited (255)`, basta `docker compose up -d`; con la política de reinicio ya no debería ocurrir.
- `docker builder prune` libera la caché de builds si el disco va justo.

---

## 2. Configuración (`.env`)

`.env.docker` es la plantilla para Docker. Claves relevantes:

| Clave | Valor local | Notas |
|---|---|---|
| `APP_URL` | `http://localhost:8080` | |
| `DB_CONNECTION` / `DB_HOST` | `pgsql` / `db` | Usuario `ncie`, contraseña `ncie_password`, BD `ncie` |
| `MAIL_MAILER` | `log` | Los correos se escriben en `storage/logs/laravel.log`. Para SMTP real, configurar `MAIL_HOST`, `MAIL_USERNAME` y una contraseña de aplicación en `.env`, nunca en el repositorio. |
| `NCIE_EMAIL_VERIFICATION` | `false` | Ver sección 4. |
| `SESSION_DRIVER` / `CACHE_DRIVER` / `QUEUE_CONNECTION` | `file` / `file` / `sync` | Sin colas ni Redis. |

Tras cambiar `.env`: `docker compose exec app php artisan config:clear`.

---

## 3. Cuentas de demostración

`DemoSeeder` siembra 7 áreas, 7 gestores con horario, 3 administrativos, 12 alumnos, 4 usuarios externos, 10 cursos (pasados, en curso y próximos respecto al día de ejecución), inscripciones, 8 proyectos con foto, presupuestos, avisos y notificaciones. Es re-ejecutable: borra los datos del dominio y todos los usuarios que no sean admin antes de sembrar.

Contraseña para todas las cuentas: `12345678`.

| Rol | Correo |
|---|---|
| Admin (`DatabaseSeeder`) | `sistemancie@gmail.com` |
| Administrativo | `admin.ncie1@itcj.edu.mx`, `admin.ncie2@…`, `admin.ncie3@…` |
| Gestor | `gestor1@itcj.edu.mx` … `gestor7@itcj.edu.mx` |
| Alumno | `l21110001@cdjuarez.tecnm.mx` … `l21110012@cdjuarez.tecnm.mx` |
| Usuario | `laura.beltran@gmail.com` y otros tres |

Las fotos de proyecto (`public/uploads/fotos/proyecto-1..8.jpg`) las copia el seeder desde `public/assets/img/gallery`; el directorio `uploads/` no se versiona.

---

## 4. Verificación de correo

`config/ncie.php` expone `email_verification`, leído de `NCIE_EMAIL_VERIFICATION`.

- `false` (actual): `RegisterController` marca `email_verified_at` al crear la cuenta, no envía correo y redirige a `/admin`. Los textos del sitio que hablaban de verificar el correo se ocultan solos.
- `true`: se envía la notificación de verificación, se muestra `auth/registered` y el middleware `verified` exige el enlace antes de entrar al panel.

Cambiar el valor y ejecutar `config:clear`. Con `MAIL_MAILER=log` el enlace de verificación queda en el log; buscar `email/verify/`.

---

## 5. Sitio público

Vista `resources/views/index.blade.php` con datos de `WebController@index` (áreas, área seleccionada y proyectos con gestores y sus áreas). Estilos en `public/assets/css/ncie.css`; no se carga Bootstrap ni jQuery, solo Bootstrap Icons y GLightbox (galería).

### Sistema visual

Tokens en `:root` de `ncie.css`: fondo `#070A14` y `#0B1230`, rojo `#E5323F` y `#7A1020`, azul `#4F7DFF` y `#1B2E7A`, texto `#EEF1F8`, vidrio `rgba(255,255,255,.06)` con desenfoque de 18 px, radios de 28, 22 y 16 px. Una sola familia tipográfica, Archivo variable, con titulares expandidos al 112 %.

### Comportamientos (script al final de `index.blade.php`)

| Comportamiento | Cómo funciona |
|---|---|
| Escenas de fondo | Cuatro capas de auroras en `.aurora`; cada sección lleva `data-scene` y un `IntersectionObserver` cambia `data-scene` en `<html>`. Las auroras se desplazan según `--scroll`. |
| Menú | Isla de vidrio fija; el enlace de la sección visible se marca; barra de progreso de lectura en el borde inferior. Menú plegable en móvil. |
| Horario de gestores | `fetch('/areas/{id}')` con token para descartar respuestas tardías, aborto a los 6 s, un reintento y botón "Reintentar". El servidor responde con `Content-Length` explícito. |
| Video | `<video preload="none">` con portada y botón; controles nativos al reproducir; al terminar vuelve la portada. |
| Preguntas frecuentes | `<details>` con apertura animada y una sola pregunta abierta a la vez. |
| Buzón de sugerencias | `fetch` a `POST /sugerencias/enviar`; solo acepta correos de usuarios registrados. |
| Volver arriba | Botón flotante que aparece al pasar la primera sección. |

Parcial del horario: `resources/views/cargar_datos_areas.blade.php` (tabla por gestor y día, con el día de hoy marcado).

---

## 6. Acceso

Layout `resources/views/layouts/auth.blade.php`: pantalla dividida con imagen lateral y formulario. Cada vista declara `auth-theme` (`blue` o `red`), `auth-side` (`left` o `right`), `auth-image` y los textos del lateral. Iniciar sesión, recuperar y restablecer usan azul; crear cuenta y cuenta creada usan rojo con la imagen a la derecha.

Vistas: `auth/login`, `auth/register` (términos en `<dialog>`), `auth/passwords/email|reset|confirm`, `auth/verify`, `auth/registered`.

---

## 7. Panel

Layout `resources/views/layouts/admin.blade.php` sobre AdminLTE 3 con `layout-fixed layout-navbar-fixed`; tema en `public/dist/css/ncie-admin.css` (se carga al final para sobrescribir). El menú lateral recuerda si está plegado (`data-enable-remember`).

### Menú por rol

| Grupo | Entradas | Roles |
|---|---|---|
| Inicio | Dashboard | todos |
| Personas | Usuarios, Administrativos, Alumnos, Gestores | admin (usuarios y administrativos), admin y administrativo (resto) |
| Académico | Áreas, Horarios, Cursos, Asignación de cursos | admin, administrativo |
| Proyectos | Proyectos, Proyectos a gestores, Proyectos a alumnos, Presupuestos | admin, administrativo |
| Mi espacio | Mis cursos, Inscritos a mis cursos, Mis proyectos | alumno, usuario, gestor según permisos |
| Comunicación | Crear aviso, Notificaciones | avisos: admin, administrativo, gestor; notificaciones: todos |

Cada entrada abre el listado; el botón de crear está en cada listado. Cerrar sesión queda fijo al pie del menú.

### Formularios y listados

Estilos globales en `ncie-admin.css`: campos de 44 px con foco azul, etiquetas con asterisco rojo para obligatorios, botón "Cancelar" blanco y principal en degradado azul. Los listados usan DataTables con exportación a PDF, Excel e impresión.

### Avisos

`POST /post/create` valida `title`, `description` y `for_users_only` (0 o 1). `PostEvent` → `PostListener` crea una `PostNotification` para cada usuario de los roles destino. `POST /mark-as-read` marca una o todas las notificaciones y responde JSON; la vista `post/notifications` actualiza la bandeja y la campana sin recargar.

---

## 8. Requisitos y dependencias

**Con Docker:** Docker Engine 24+ y Compose v2; unos 2 GB para imágenes. Internet solo durante el build (Composer y npm) y en el navegador para Google Fonts, jsdelivr (FullCalendar, SweetAlert2, Bootstrap Icons del panel) y ui-avatars.

**Sin Docker:** PHP 8.2 con `pdo_pgsql` (o `pdo_mysql`), Composer 2, Node 18+, PostgreSQL 15/16 o MySQL 8, NGINX + PHP-FPM o Apache. Escritura en `storage/`, `bootstrap/cache/` y `public/uploads/fotos/`.

Paquetes PHP principales: `laravel/framework` ^10.10, `laravel/ui` ^4.6, `spatie/laravel-permission` ^6.20, `laravel/sanctum` ^3.3 (sin uso propio). Desarrollo: PHPUnit 10, PHPStan, Pint.

Frontend estático: AdminLTE 3 y su bundle de plugins en `public/dist` y `public/plugins`; Bootstrap Icons y GLightbox en `public/assets/vendor`; FullCalendar 6 por CDN con locale español en `public/fullcalendar/`.

---

## 9. Calidad

- `docker compose exec app php artisan test`: pruebas de humo (`tests/Feature/BasicFlowTest.php`).
- `docker compose exec app vendor/bin/phpstan analyze`: análisis estático nivel 5 sobre `app/` y `tests/`.
- `.github/workflows/laravel-ci.yml`: PHP 8.2, MySQL de servicio, build de Vite, PHPStan y PHPUnit en cada push a `main` o `develop`.

---

## 10. Compatibilidad con PostgreSQL

No hay SQL crudo en `app/`; todo es Eloquent y las migraciones corren sin cambios. Diferencias de comportamiento que conviene tener presentes:

| Tema | Estado |
|---|---|
| Comparación de texto sensible a mayúsculas (login, buzón, `unique:users,email`) | Pendiente: normalizar correos a minúsculas e índice único sobre `lower(email)`. |
| Listados sin `ORDER BY` | Pendiente: añadir `orderBy` en los `index()`. |
| `enum` de `alumno_proyecto.tipo` | Funciona: Laravel lo crea como `varchar` + `CHECK`. |
| `fecha_nacimiento` como texto | Pendiente: migrar a `date`. |
| Migración duplicada `password_resets` | Pendiente: eliminar la migración heredada. |
| Secuencias tras importar datos con IDs explícitos | Ejecutar `setval` por tabla si se importa desde otro motor. |

---

## 11. Seguridad

- `.env`, `.env.*.backup`, `manuales/`, `Bitacoras/` y `SKILL.md` están en `.gitignore`.
- Las contraseñas del hosting anterior y de la cuenta de Gmail que existieron en versiones previas de este documento deben considerarse comprometidas y rotarse.
- Toda ruta del panel exige `auth`, `verified` y su permiso; el registro público solo otorga el rol `usuario`.
