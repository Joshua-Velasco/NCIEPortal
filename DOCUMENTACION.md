# Sistema NCIE — Documentación técnica y guía de arranque con Docker

> Complementa a [INFO.md](INFO.md). Fecha: 2026-08-25.
>
> ⚠️ **Este archivo contiene credenciales. No lo subas a ningún repositorio público** (agrégalo a `.gitignore` junto con `.env`).

---

## 1. Credenciales

### Aplicación (usuario administrador sembrado por `DatabaseSeeder`)

| Campo | Valor |
|---|---|
| URL del panel | `/admin` (tras iniciar sesión en `/login`) |
| Email | `sistemancie@gmail.com` |
| Contraseña | `12345678` |
| Rol | `admin` (acceso total) |

Se crea al ejecutar `php artisan migrate --seed`. Cualquier persona que se registre por `/register` recibe el rol `usuario` (solo inscripciones a cursos) y debe verificar su correo antes de entrar.

### Base de datos

| Entorno | Motor | Host | BD | Usuario | Contraseña |
|---|---|---|---|---|---|
| Local (XAMPP, actual `.env`) | MySQL | `127.0.0.1:3306` | `u868517925_ncie` | `root` | *(vacía)* |
| Producción Hostinger (comentada en `.env`) | MySQL | — | `u868517925_ncie` | `u868517925_ncie` | `<redactada>` |
| **Docker (nuevo)** | PostgreSQL 16 | servicio `db:5432` | `ncie` | `ncie` | `ncie_password` |

### Correo (SMTP)

| Campo | Valor |
|---|---|
| Servidor | `smtp.gmail.com:587` (TLS) |
| Usuario / remitente | `sistemancie@gmail.com` |
| Contraseña de aplicación | `<redactada>` (en el `.env` actual) |

> 🔐 **Recomendación**: la contraseña de producción de Hostinger y la contraseña de aplicación de Gmail están en texto plano en `.env`. Rótalas si este código se compartió, y nunca las copies a `.env.example`. En `.env.docker` el campo `MAIL_PASSWORD` se dejó vacío a propósito.

---

## 2. Opciones del panel de administración

El panel (`/admin`, plantilla AdminLTE 3) muestra un **dashboard** con tarjetas de totales por módulo y el **Calendario de cursos del nodo** (FullCalendar en español). El menú lateral se filtra por permisos (`@can`), así que cada rol ve solo lo suyo:

| Opción del menú | Submenús | Roles que la ven |
|---|---|---|
| Usuarios | Creación / Listado de usuarios | admin |
| Administrativos | Creación / Listado de administrativos | admin |
| Alumnos | Creación / Listado de alumnos | admin, administrativo |
| Áreas | Creación / Listado de áreas | admin, administrativo |
| Gestores | Creación / Listado de gestores | admin, administrativo |
| Horarios | Creación / Listado de horarios (atención por gestor y área) | admin, administrativo |
| Cursos | Creación / Listado de cursos | admin, administrativo |
| Proyectos | Creación / Listado de proyectos | admin, administrativo |
| Asignaciones (gestor ↔ curso) | Creación / Listado de asignaciones | admin, administrativo |
| Asignación de proyectos a gestores | Creación / Listado | admin, administrativo |
| Asignación de proyectos a alumnos | Creación / Listado | admin, administrativo |
| Presupuestos | Creación de registro / Listado de presupuestos | admin, administrativo |
| Mis cursos | Listado de mis cursos (con opción de abandonar) | alumno, usuario |
| Mis proyectos (alumno) | Listado de mis proyectos | alumno |
| Reportes | Mis cursos impartidos / Inscripciones de mis cursos | gestor |
| Mis proyectos (gestor) | Listado de mis proyectos | gestor |
| Notificaciones | Crear notificación (aviso) | admin, administrativo, gestor |
| Notificaciones (ver) | Bandeja + campana con no leídas | todos los autenticados |

Barra superior: campana de notificaciones, pantalla completa, avatar (generado con ui-avatars.com) y cerrar sesión. Los listados usan DataTables con exportación a PDF/Excel/impresión.

---

## 3. Requisitos del sistema

### Con Docker (recomendado, lo que montamos aquí)

- **Docker Engine 24+** y **Docker Compose v2** (Docker Desktop en macOS/Windows).
- ~2 GB de disco para imágenes (php:8.2-fpm-alpine, nginx:1.27-alpine, postgres:16-alpine, node:20-alpine) + volumen de datos.
- Salida a internet **solo durante el build** (composer/npm); en ejecución los CDN los carga el navegador del usuario.

### Sin Docker (stack clásico, referencia)

- **PHP ≥ 8.2** — aunque `composer.json` declara `^8.1`, el `composer.lock` ya resolvió paquetes Symfony 7 y Laravel Pint que exigen 8.2.
- Extensiones PHP: las incluidas por defecto (ctype, curl, dom, fileinfo, filter, hash, iconv, json, libxml, mbstring, openssl, pcre, pdo, session, tokenizer, xml) **+ `pdo_pgsql`** para PostgreSQL (o `pdo_mysql` si sigues en MySQL). No se usa GD, Imagick, intl, zip ni exif en el código.
- **Composer 2**, **Node.js 18+** (Vite 5) y npm.
- Base de datos: PostgreSQL 15/16 (o MySQL 8/MariaDB en el stack original).
- Servidor web: NGINX + PHP-FPM (o Apache con el `.htaccess` estándar de Laravel).
- Carpetas con permiso de escritura para PHP: `storage/`, `bootstrap/cache/` y `public/uploads/fotos/` (ahí se guardan las fotos de proyectos con `move()`, sin usar `storage/`).

---

## 4. Dependencias y librerías

### PHP (composer.json)

| Paquete | Versión | Para qué |
|---|---|---|
| `laravel/framework` | ^10.10 | Framework base |
| `laravel/ui` | ^4.6 | Scaffolding de autenticación Blade (login, registro, reset, verificación) |
| `laravel/sanctum` | ^3.3 | Tokens API (instalado pero sin rutas propias — solo `/api/user`) |
| `laravel/tinker` | ^2.8 | REPL de consola |
| `spatie/laravel-permission` | ^6.20 | Roles y permisos (5 roles, ~120 permisos por ruta) |
| `guzzlehttp/guzzle` | ^7.2 | Cliente HTTP (dependencia estándar) |

Dev: `phpunit/phpunit` ^10.1, `laravel/pint` (formateo), `laravel/sail`, `mockery/mockery`, `fakerphp/faker`, `nunomaduro/collision`, `spatie/laravel-ignition`.

### JavaScript (package.json — build de Vite)

`vite` ^5.0, `laravel-vite-plugin` ^1.0, `bootstrap` ^5.2.3, `sass` ^1.56, `axios` ^1.6, `@popperjs/core` ^2.11. Compila `resources/sass/app.scss` y `resources/js/app.js` (usados por los layouts `app`/`app2`).

### Librerías frontend estáticas (en `public/`, sin gestor de paquetes)

- **AdminLTE 3** (`public/dist`) sobre Bootstrap 4 + Font Awesome — todo el panel.
- **Bundle de plugins AdminLTE** (`public/plugins`, ~50 librerías): DataTables (+ botones de exportación con JSZip y pdfmake), Select2, SweetAlert2, Chart.js, Moment, Daterangepicker, Summernote, Dropzone, etc.
- **Plantilla "Medilab" de BootstrapMade** (`public/assets`) sobre Bootstrap 5, con AOS, GLightbox, Swiper y PureCounter — la landing pública.
- **FullCalendar 6.1.18** — por CDN (jsdelivr) + locale español local en `public/fullcalendar/es.global.js`.

### Cargado por CDN en el navegador

jsdelivr (FullCalendar, SweetAlert2, Bootstrap Icons), Google Fonts (Source Sans Pro), bunny.net (fuentes) y ui-avatars.com (avatares). El servidor no necesita internet para servir la app, pero el navegador sí para que la UI se vea completa.

---

## 5. Migración LAMP → Docker (NGINX + PHP-FPM + PostgreSQL)

### Archivos creados

```
docker-compose.yml            # orquesta los 4 servicios
docker/php/Dockerfile         # php:8.2-fpm-alpine + pdo_pgsql, bcmath, zip, opcache + Composer 2
docker/nginx/default.conf     # NGINX sirviendo public/ y reenviando .php a app:9000
.env.docker                   # plantilla de entorno para Docker (pgsql, host "db")
```

Servicios de `docker-compose.yml`:

| Servicio | Imagen | Puerto | Función |
|---|---|---|---|
| `app` | build de `docker/php/Dockerfile` | 9000 (interno) | PHP-FPM con la aplicación |
| `nginx` | nginx:1.27-alpine | **8080 → 80** | Servidor web |
| `db` | postgres:16-alpine | 5432 | PostgreSQL (BD `ncie`, collation española vía ICU, volumen `pgdata`) |
| `node` | node:20-alpine (perfil `assets`) | — | Compila los assets de Vite bajo demanda |

### 🚀 Cómo iniciar el proyecto

```bash
# 0) Situarte en la raíz del proyecto
cd /Volumes/Dev/XAMPP_External/xamppfiles/htdocs/public_html

# 1) Respaldar tu .env de XAMPP y activar el de Docker
cp .env .env.xampp.backup
cp .env.docker .env

# 2) Levantar los contenedores (construye la imagen PHP la primera vez)
docker compose up -d --build

# 3) Instalar dependencias PHP y generar la clave de la app
docker compose exec app composer install
docker compose exec app php artisan key:generate

# 4) Crear el esquema en PostgreSQL y sembrar roles + usuario admin
docker compose exec app php artisan migrate --seed

# 5) Compilar los assets de Vite (una sola vez, o tras cambiar sass/js)
docker compose run --rm node        # ejecuta npm install && npm run build

# 6) Permisos de escritura para PHP-FPM (storage, cache y fotos de proyectos)
docker compose exec app chown -R www-data:www-data storage bootstrap/cache public/uploads
```

Abrir **http://localhost:8080** → landing pública; **http://localhost:8080/login** → entrar con `sistemancie@gmail.com` / `12345678`.

Comandos útiles:

```bash
docker compose logs -f nginx app db      # ver logs
docker compose exec app php artisan tinker
docker compose exec db psql -U ncie ncie # consola PostgreSQL
docker compose down                      # apagar (los datos persisten en el volumen pgdata)
docker compose down -v                   # apagar Y BORRAR la base de datos
```

> Nota: se eliminó el archivo residual `public/hot` (marcador del dev server de Vite copiado del entorno anterior); si vuelves a ejecutar `npm run dev` y lo cancelas mal, bórralo de nuevo o las vistas con `@vite` intentarán cargar assets desde `http://[::1]:5173`.

### Migrar los datos existentes de MySQL (opcional)

Si necesitas conservar los datos que ya tienes en XAMPP (no solo el esquema):

1. **Crea el esquema con Laravel** (`migrate --seed`, paso 4 de arriba). Nunca dejes que la herramienta de migración cree las tablas: convertiría el `enum` de MySQL a un tipo incompatible con lo que Laravel espera.
2. Copia **solo los datos** con [pgloader](https://pgloader.io) (`WITH data only, reset sequences`) o con dumps transformados.
3. Si tu herramienta no resetea secuencias, hazlo a mano o los siguientes INSERT fallarán con `duplicate key`:
   ```sql
   SELECT setval(pg_get_serial_sequence('users','id'), COALESCE(MAX(id),1)) FROM users;
   -- repetir para: alumnos, gestores, administrativos, areas, horarios, cursos, proyectos,
   -- gestor_curso, gestor_proyecto, alumno_proyecto, inscripciones, posts, presupuestos,
   -- permissions, roles, failed_jobs, personal_access_tokens
   ```
4. Ejecuta `docker compose exec app php artisan permission:cache-reset`.

---

## 6. Compatibilidad MySQL → PostgreSQL (hallazgos del escaneo)

**La buena noticia**: no existe ni una línea de SQL crudo ni funciones MySQL (`DB::raw`, `GROUP_CONCAT`, `DATE_FORMAT`, `LIKE`…) en `app/` — todo es Eloquent portable, y las migraciones (incluida la de Spatie) corren en PostgreSQL sin cambios. Las diferencias reales son de **comportamiento**:

| # | Problema | Dónde | Solución recomendada |
|---|---|---|---|
| 1 | En Postgres la comparación de texto es **sensible a mayúsculas**: el login y el buzón de sugerencias no encontrarán `Juan@Mail.com` si escriben `juan@mail.com`, y la regla `unique:users,email` dejará crear "duplicados" con distinta capitalización | `SugerenciaController:23`; validaciones en `UsuarioController`, `GestorController`, `AlumnoController`, `AdministrativoController` | Normalizar el email con `strtolower` al guardar y buscar (mutator en `User`), y crear un índice único funcional `ON users (lower(email))` |
| 2 | Listados sin `ORDER BY`: en Postgres el orden de `Model::all()` es indefinido — las tablas del panel pueden salir "desordenadas", el área por defecto de la portada puede variar, y los colores del calendario cambiar entre recargas | Todos los `index()`; `WebController:13`, `HorarioController:18`, `AdminController:37`, `CursoController:32-44` | Añadir `->orderBy('id')` (o `nombre`) a los listados; en el calendario derivar el color de `$curso->id % count($colors)` |
| 3 | Columna `enum('tipo',…)` de `alumno_proyecto` | Migración `2025_07_29_…` | Laravel la crea en Postgres como `varchar + CHECK` (funciona); idealmente cambiar a `string('tipo', 20)` y validar en la app (ya se valida con `in:`) |
| 4 | `fecha_nacimiento` guardada como **string** en `alumnos` y `gestores`: cualquier comparación futura contra fechas lanzará error de tipos en Postgres | Migraciones de alumnos y gestores | Cambiar a `$table->date('fecha_nacimiento')` y normalizar datos a `YYYY-MM-DD` |
| 5 | Secuencias desincronizadas tras importar datos con IDs explícitos | Toda tabla con `id` autoincremental | `setval(...)` por tabla (ver sección 5) |
| 6 | Migración duplicada `create_password_resets_table` (legado, Laravel 10 usa `password_reset_tokens`) | `database/migrations/2014_10_12_100000_*` | Eliminar la migración legada antes del `migrate` limpio |
| 7 | Typo preexistente `feha_inicio` que impide actualizar la fecha de inicio de un curso (falla igual en ambos motores) | `CursoController:158` | Corregir a `fecha_inicio` aprovechando la migración |

Ninguno de estos puntos impide que la app **arranque** en Docker/PostgreSQL — los pasos de la sección 5 funcionan tal cual; los ítems 1, 2 y 4 son correcciones de código recomendadas para que el comportamiento sea idéntico al que tenías en MySQL.
