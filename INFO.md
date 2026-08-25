# Sistema NCIE

> Documento generado a partir de un análisis completo del código (rutas, controladores, modelos, migraciones, vistas, configuración y seeders). Fecha de análisis: 2026-08-25.

## ¿Qué es este proyecto?

**Sistema NCIE** es una aplicación web de gestión académico-administrativa hecha a medida para el **Nodo de Creatividad, Innovación y Emprendimiento (NCIE)** del **Instituto Tecnológico de Ciudad Juárez (ITCJ / TecNM)**. Fue desplegada en `https://ncie.com.mx` (hosting Hostinger, tras Cloudflare).

La aplicación tiene dos caras:

1. **Sitio público (landing)** — página informativa del nodo construida sobre la plantilla "Medilab" de BootstrapMade (Bootstrap 5, AOS, GLightbox, Swiper), con secciones de inicio, acerca de, áreas del nodo, gestores, galería y contacto, más un **buzón de sugerencias** que envía correo a `sistemancie@gmail.com` (solo para usuarios registrados con email verificado).
2. **Panel interno (back-office)** — sistema multi-rol sobre **AdminLTE 3** para administrar todo el funcionamiento del nodo: personas, áreas, horarios de atención, cursos con calendario e inscripciones, proyectos, presupuestos, reportes y avisos internos.

El NCIE (fundado ~2016 en el ITCJ) trabaja en áreas como desarrollo de software, inteligencia artificial, realidad aumentada, impresión 3D, manufactura, IoT y energías renovables — las "áreas" que administra el sistema.

## Stack tecnológico

| Componente | Tecnología |
|---|---|
| Framework | Laravel 10 (PHP ≥ 8.1) |
| Base de datos | MySQL (`u868517925_ncie` en producción) |
| Autenticación | laravel/ui (sesión clásica Blade) con verificación de email obligatoria |
| Autorización | spatie/laravel-permission (roles + permisos por ruta con middleware `can:*`) |
| API | Laravel Sanctum instalado pero **sin usar** (solo el endpoint genérico `/api/user`) |
| Frontend panel | Blade + AdminLTE 3 (Bootstrap 4), DataTables (export PDF/Excel/print), SweetAlert2, Select2, FullCalendar 6 (locale `es`) |
| Frontend público | Plantilla Medilab (Bootstrap 5) en `public/assets/` |
| Build | Vite 5 (Bootstrap 5 + Sass), aunque el panel usa en la práctica los assets estáticos de `public/dist` y `public/plugins` |
| Correo | SMTP de Gmail (`sistemancie@gmail.com`) |
| Idioma | Español en su totalidad (`locale es`, `resources/lang/es/`) |

## Roles y permisos

Cinco roles sembrados por `database/seeders/RoleSeeder.php`, con ~120 permisos nombrados igual que las rutas (`admin.cursos.index`, `inscripciones.store`, …):

| Rol | Qué puede hacer |
|---|---|
| **admin** | Todo. Único que gestiona usuarios (`/admin/usuarios`) y administrativos (`/admin/administracion`). |
| **administrativo** | Gestión operativa: alumnos, áreas, gestores, horarios, cursos, proyectos, asignaciones y presupuestos. |
| **gestor** | Reportes de sus cursos/proyectos asignados y creación de avisos (posts). |
| **alumno** | Inscribirse a cursos, ver "mis cursos" y "mis proyectos". |
| **usuario** | Rol por defecto al auto-registrarse: inscribirse a cursos y ver "mis cursos". |

`DatabaseSeeder` crea un usuario administrador por defecto (`sistemancie@gmail.com`). El registro público exige aceptar términos, asigna el rol `usuario` y obliga a verificar el correo antes de entrar al panel.

## Módulos funcionales

### Panel de administración (`/admin`)
- **Dashboard** — tarjetas con totales de cada entidad + "Calendario de cursos del nodo" (FullCalendar, alimentado por `/admin/cursos/calendar-events`).
- **Usuarios / Administrativos / Gestores / Alumnos** — CRUDs que crean un `User` + su perfil y le asignan rol. El alumno guarda `numero_control` (8 dígitos, único), carrera, semestre y celular; gestores y administrativos guardan carrera y grado académico.
- **Áreas** — catálogo de áreas del nodo (nombre + descripción).
- **Horarios** — horario de atención de cada gestor en un área (días LUNES–VIERNES, hora inicio/fin); un gestor solo puede tener un horario. Se muestran agrupados por gestor en la landing pública vía AJAX.
- **Cursos** — CRUD con fechas, horario, lugar, requisitos, modalidad (`presencial` | `en_linea`) y descripción.
- **Asignaciones** — pivote gestor↔curso, con validación de solapamiento de horarios entre los cursos de un mismo gestor.
- **Proyectos** — CRUD con foto (se guarda en `public/uploads/fotos`).
- **Proyecto–Gestores** y **Alumno–Proyecto** — vinculación de responsables y participantes a proyectos.
- **Presupuestos** — registro contable simple del centro (motivo, monto, fecha); *no* está ligado a proyectos.

### Zona de alumno/usuario
- **Inscripciones** — el usuario ve los cursos disponibles (con gestor asignado, no finalizados, no inscritos ya) y se inscribe; se valida que el curso no haya empezado hace más de 2 días, que no haya duplicados y que **no choque en fechas/horarios** con otros cursos ya inscritos. Puede abandonar un curso desde "Mis cursos".
- **Mis proyectos** — el alumno ve los proyectos en que participa, con tipo `residencias` | `servicio_social` | `propio` (figuras del TecNM) y fechas.

### Zona de gestor
- **Reportes** — lista de sus cursos con los alumnos inscritos, sus cursos asignados y sus proyectos.

### Comunicación interna
- **Avisos (posts)** — admin, administrativo o gestor publica un aviso; un evento (`PostEvent` → `PostListener`) genera notificaciones de base de datos (`PostNotification`) para todos los usuarios de los roles destino (o solo rol `usuario` si se marca `for_users_only`). Campana de notificaciones en el layout del panel con marcado de leídas.
- **Buzón de sugerencias** — desde la landing, envía un `SugerenciaMail` al correo del nodo.

## Modelo de datos

Entidades principales (14 modelos, migraciones fechadas mayo–agosto 2025):

- `users` — autenticación; se especializa 1:1 en `administrativos`, `gestores` o `alumnos` (FK `user_id`, borrado en cascada; al borrar el perfil también se elimina el `User`).
- `areas` ← `horarios` → `gestores` — la relación gestor↔área se materializa a través del horario de atención.
- `cursos` ↔ `gestores` vía pivote `gestor_curso`; `users` ↔ `cursos` vía `inscripciones` (única por usuario+curso — cualquier usuario, no solo alumnos, puede inscribirse).
- `proyectos` ↔ `gestores` vía `gestor_proyecto`; `proyectos` ↔ `alumnos` vía `alumno_proyecto` con `tipo enum('residencias','servicio_social','propio')` y fechas.
- `posts` (avisos, con autor) y `notifications` (notificaciones nativas de Laravel).
- `presupuestos` (motivo, monto decimal, fecha) — sin FK, registro general.
- Tablas de Spatie (`roles`, `permissions`, `model_has_roles`, …) y las estándar de Laravel (Sanctum, failed_jobs, password resets).

No hay observers, tareas programadas, colas (queue `sync`) ni broadcasting real; los tests son solo los `ExampleTest` de fábrica.

## Estructura relevante

```
app/Http/Controllers/   20 controladores (Web, Admin, Usuario, Administrativo, Alumno,
                        Gestor, Area, Horario, Curso, Asignacion, Inscripcion, Proyecto,
                        ProyectoGestor, AlumnoProyecto, Presupuesto, Reporte, Post,
                        Sugerencia, Home + Auth/ de laravel/ui)
app/Models/             14 modelos del dominio
app/Events|Listeners|Notifications/  flujo de avisos (PostEvent → PostNotification)
app/Mail/               SugerenciaMail
routes/web.php          ~214 líneas; toda ruta protegida con auth + verified + can:<ruta>
resources/views/        admin/ (CRUDs), inscripciones/, reportes/, post/, auth/,
                        layouts/ (AdminLTE), index.blade.php (landing Medilab)
public/dist, plugins/   assets AdminLTE 3
public/assets/          plantilla Medilab de la landing
public/fullcalendar/    locale español de FullCalendar
public/uploads/fotos/   fotos de proyectos subidas (contiene imágenes de prueba)
```

## Estado del proyecto y observaciones

Esta copia es un **árbol de trabajo/desarrollo** (volcado desde el hosting), no un despliegue productivo pulido. Indicios y problemas detectados durante el análisis:

- `default1.php` en la raíz es la página por defecto de **Hostinger** (residuo del hosting, no forma parte de la app), y `auth/login.blade.php` trae incrustado el script Zaraz de Cloudflare (copiado de producción).
- `public/hot` (marcador del dev server de Vite, `http://[::1]:5173`) está presente: rompería los assets de las vistas que usan `@vite` en cualquier despliegue real.
- **Bug de permisos**: en `routes/web.php` las rutas `admin.proyecto_gestores.edit/update` pasan el nombre del permiso como middleware **sin el prefijo `can:`**, por lo que esa protección no aplica (o la ruta falla).
- **Ruta rota**: `POST /mark-as-read` usa la sintaxis string antigua `'PostController@markNotification'` sin namespace (falla en Laravel 10); además `web.php` importa un `NotificationController` que no existe.
- `GET /admin/cursos/calendar-events` solo exige `auth` (sin `verified` ni permiso), a diferencia del resto del módulo de cursos.
- Ruta de reenvío de verificación de email **duplicada**: la segunda definición (throttle `6,1`) pisa a la primera, anulando el throttle estricto personalizado (1 cada 5 min).
- Typo `feha_inicio` en el `update` de `CursoController` que probablemente impide actualizar la fecha de inicio de un curso.
- Relaciones muertas en modelos: `Administrativo::curso()` y `Gestor::area()` apuntan a columnas que no existen en sus tablas; `fecha_nacimiento` se guarda como string, no como date.
- Las fotos de proyectos se guardan directamente en `public/uploads/fotos` (sin usar `storage/` ni symlink); las 9 imágenes presentes son datos de prueba.

## Cómo levantarlo en local (referencia rápida)

1. `composer install` y copiar `.env.example` a `.env` (`php artisan key:generate`).
2. Configurar MySQL en `.env` y ejecutar `php artisan migrate --seed` (siembra roles/permisos y el usuario admin).
3. Eliminar `public/hot` si existe, o ejecutar `npm install && npm run build`.
4. Servir con XAMPP/`php artisan serve`. El usuario admin sembrado es `sistemancie@gmail.com` (contraseña definida en `DatabaseSeeder`).


A) Arranque diario (después de reiniciar la Mac o apagar Docker)

cd /Volumes/Snowden/public_html
## docker compose up -d          # levanta nginx + app + db (sin rebuild)

Abre http://localhost:8080. Eso es todo: la base de datos vive en el volumen pgdata, así que los datos de demo se conservan.

Opcionales según el caso:

docker compose exec app php artisan view:clear      # si editaste vistas Blade y no ves el cambio
docker compose exec app php artisan db:seed --class=DemoSeeder   # re(borra y re-siembra; conserva al admin)
docker compose down                                  # apagar (los datos se quedan)

B) Instalación desde cero (máquina nueva o clon limpio)

Requisitos: Docker Desktop con Compose v2.

# 1) Raíz del proyecto
cd /Volumes/Snowden/public_html

# 2) Entorno de Docker (solo si no existe .env o viene de XAMPP)
cp .env.docker .env

# 3) Construir y levantar contenedores
docker compose up -d --build

# 4) Dependencias PHP y clave de la app
docker compose exec app composer install
docker compose exec app php artisan key:generate

# 5) Esquema en PostgreSQL + roles/permisos + usuario admin
docker compose exec app php artisan migrate --seed

# 6) Datos de demostración
docker compose exec app php artisan db:seed --class=DemoSeeder

# 7) Assets de Vite (solo los usan layouts/app y app2; la landing y e
docker compose --profile assets run --rm node

# 8) Permisos de escritura (si Laravel se queja de storage/ o bootstrap/cache)
docker compose exec app chmod -R ug+rw storage bootstrap/cache public/uploads/fotos

Luego http://localhost:8080 → admin sistemancie@gmail.com / 12345678 (el resto de cuentas de demo están en mi mensaje anterior).

Advertencias
                                                                                                                                                                     docker compose down -v borra el volumen de PostgreSQL (pierdes toda para apagar.
- DOCUMENTACION.md sección 5 tiene esta misma guía pero con la ruta vieja (/Volumes/Dev/XAMPP_External/...) y aún describe Hostinger/MySQL como producción; conviene actualizarla a la ruta actual y quitar lo de Hostinger. Si quieres,
- Si el puerto 8080 o 5432 está ocupado, cámbialo en docker-compose.yml ("8080:80" / "5432:5432") y en APP_URL del .env.
