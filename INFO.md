# Sistema NCIE

> Descripción funcional del sistema. Actualizada el 2026-09-11 para la versión 2.0.0. La guía técnica está en [DOCUMENTACION.md](DOCUMENTACION.md) y la base de datos en [BD_DIAGRAMA.md](BD_DIAGRAMA.md).

## Qué es este proyecto

**Sistema NCIE** es la aplicación web del **Nodo de Creatividad, Innovación y Emprendimiento (NCIE)** del **Instituto Tecnológico de Ciudad Juárez (ITCJ, TecNM)**. El nodo, fundado en 2016, trabaja bajo un modelo dual entre academia y empresa en siete áreas: desarrollo de software, inteligencia artificial, realidad virtual y aumentada, impresión 3D, manufactura, Internet de las cosas y energías renovables.

La aplicación tiene tres partes:

1. **Sitio público.** Presenta el nodo, sus áreas, el horario de atención de cada gestor, los proyectos en curso, la galería y un buzón de sugerencias. Es la puerta de entrada para estudiantes y comunidad.
2. **Acceso.** Registro e inicio de sesión. Cualquier persona puede crear una cuenta; recibe el rol `usuario` y puede inscribirse a cursos desde el panel.
3. **Panel interno.** Sistema multi-rol para administrar personas, áreas, horarios, cursos e inscripciones, proyectos, presupuestos y avisos.

Desde agosto de 2026 el sistema se ejecuta en un entorno Docker local con PostgreSQL. Ya no se despliega en el hosting compartido donde nació.

## Stack tecnológico

| Componente | Tecnología |
|---|---|
| Framework | Laravel 10 sobre PHP 8.2 |
| Base de datos | PostgreSQL 16 (las migraciones también funcionan en MySQL) |
| Entorno | Docker Compose: NGINX, PHP-FPM, PostgreSQL y Node para compilar assets |
| Autenticación | laravel/ui con sesión clásica; verificación de correo opcional (`config/ncie.php`) |
| Autorización | spatie/laravel-permission: 5 roles y 105 permisos nombrados como las rutas |
| Sitio público y acceso | Blade + CSS propio (`public/assets/css/ncie.css`), Bootstrap Icons, GLightbox; sin Bootstrap ni jQuery |
| Panel | Blade + AdminLTE 3 (Bootstrap 4) con tema propio (`public/dist/css/ncie-admin.css`), DataTables, SweetAlert2, FullCalendar 6 |
| Tipografía | Archivo (fuente variable de Google Fonts) en todo el sistema |
| Correo | En local se registra en `storage/logs/laravel.log` (`MAIL_MAILER=log`); en producción, SMTP |
| Idioma | Español (`resources/lang/es/`) |

## Roles y permisos

`database/seeders/RoleSeeder.php` siembra cinco roles. Cada ruta del panel exige `auth`, `verified` y el permiso con su mismo nombre, y el menú lateral solo muestra lo que el rol puede abrir.

| Rol | Qué puede hacer |
|---|---|
| **admin** | Todo. Único que gestiona usuarios y administrativos. |
| **administrativo** | Alumnos, áreas, gestores, horarios, cursos, proyectos, asignaciones y presupuestos. Publica avisos. |
| **gestor** | Ve sus cursos asignados, los inscritos a ellos y sus proyectos. Publica avisos. |
| **alumno** | Se inscribe a cursos y ve sus cursos y proyectos. |
| **usuario** | Rol por defecto al registrarse: se inscribe a cursos y ve sus cursos. |

`DatabaseSeeder` crea el administrador `sistemancie@gmail.com`; `DemoSeeder` agrega el resto de cuentas de demostración (ver [README.md](README.md)).

## Módulos

### Sitio público (`/`)

- **Portada.** Titular, texto de presentación y la acción principal: crear cuenta o, con sesión iniciada, ver los cursos.
- **Dos formas de participar.** Tomar un curso (abierto a todos) o unirse a un proyecto (estudiantes del ITCJ).
- **El nodo.** Video integrado que se reproduce en la misma página, y ficha con fundación, modelo, número de áreas y ubicación.
- **Áreas.** Se leen de la tabla `areas`; cada tarjeta lleva un icono elegido según el nombre del área.
- **Atención de gestores.** Selector de área y tabla con los días y horas de atención, con el día de hoy marcado. Se carga por AJAX desde `GET /areas/{id}` con protección contra respuestas tardías y reintento.
- **Proyectos.** Tabla con nombre, descripción, área y gestor de cada proyecto registrado.
- **Galería**, **contacto** con mapa y buzón de sugerencias, y **preguntas frecuentes** en acordeón.
- El fondo cambia entre cuatro escenas de color según la sección visible, respetando la preferencia de movimiento reducido.

### Acceso

- **Registro** con nombre, correo, contraseña y aceptación de términos (en un diálogo nativo).
- **Verificación de correo** configurable. Con `NCIE_EMAIL_VERIFICATION=false` (valor actual) la cuenta nace verificada y entra directo al panel; con `true` se envía el enlace y se muestran las pantallas de verificación.
- Recuperación y restablecimiento de contraseña, y confirmación de contraseña para acciones sensibles.

### Panel (`/admin`)

- **Dashboard.** Saludo, fecha, resumen de totales por módulo y calendario de cursos (FullCalendar) con detalle al hacer clic.
- **Personas.** Usuarios, administrativos, alumnos y gestores. Cada alta crea un `User` con su perfil y rol.
- **Académico.** Áreas, horarios de atención (un horario por gestor, que fija su área), cursos y asignación de gestores a cursos con validación de solapamientos.
- **Proyectos.** Proyectos con foto, asignación a gestores, participación de alumnos (residencias, servicio social o propio) y presupuestos.
- **Mi espacio.** Inscripción a cursos con validación de fechas y choques de horario, mis cursos, mis proyectos y, para gestores, reportes de inscritos.
- **Comunicación.** Crear aviso con selector de destinatarios (comunidad del nodo o solo usuarios externos). Cada aviso genera notificaciones en base de datos por rol; la bandeja permite marcar leídas una a una o todas, y conserva las últimas 30 leídas. La campana de la barra superior muestra las pendientes.

## Modelo de datos

25 tablas: 15 del dominio, 5 de Spatie Permission y 5 del framework. El diagrama entidad-relación y el diccionario completo están en [BD_DIAGRAMA.md](BD_DIAGRAMA.md). Puntos clave:

- `users` se especializa 1:1 en `administrativos`, `gestores` y `alumnos`.
- El área de un gestor se materializa en `horarios`; no hay columna `area_id` en `gestores`.
- `cursos` ↔ `gestores` por `gestor_curso`; `users` ↔ `cursos` por `inscripciones`.
- `proyectos` ↔ `gestores` por `gestor_proyecto`; `proyectos` ↔ `alumnos` por `alumno_proyecto`.
- `posts` son los avisos y `notifications` las entregas por usuario.

## Estructura del código

```
app/Http/Controllers/   Web (landing), Admin (dashboard), un controlador por módulo,
                        Post (avisos), Sugerencia (buzón) y Auth/ de laravel/ui
app/Models/             14 modelos del dominio
app/Events, Listeners, Notifications/  flujo de avisos: PostEvent → PostListener → PostNotification
config/ncie.php         interruptor de verificación de correo
database/seeders/       RoleSeeder, DatabaseSeeder (admin), DemoSeeder (datos de demostración)
docker/                 Dockerfile de PHP-FPM y default.conf de NGINX
public/assets/css/      ncie.css: sistema visual del sitio público y el acceso
public/dist/css/        ncie-admin.css: tema del panel sobre AdminLTE
resources/views/        index.blade.php, cargar_datos_areas.blade.php, auth/, layouts/, admin/, post/,
                        inscripciones/, reportes/
routes/web.php          todas las rutas
```

## Estado del proyecto

Versión 2.0.0, final del ciclo de desarrollo 2026. Historial completo en [CHANGELOG.md](CHANGELOG.md).

### Corregido durante el ciclo

- Ruta `POST /mark-as-read` que usaba la sintaxis antigua de controlador y fallaba en Laravel 10; también se eliminó la importación a un controlador inexistente.
- Clase `form group` mal escrita en decenas de formularios del panel, que rompía el espaciado.
- Pantalla de notificaciones sin forma de marcar avisos como leídos.
- Registro que fallaba con error 500 cuando el servidor de correo no estaba disponible; ahora la verificación es configurable y el correo local se registra en el log.
- Carga del horario de gestores que podía quedarse en "Cargando" por respuestas fuera de orden.
- Barra lateral del panel que se cortaba y perdía el degradado al plegarse.
- Residuos del hosting anterior (`default1.php`, archivos `._*`, fotos de prueba) retirados del repositorio.

### Pendiente conocido

- Rutas `admin.proyecto_gestores.edit` y `update` declaran el permiso sin el prefijo `can:`, por lo que esa protección no aplica.
- Error de tecleo `feha_inicio` en `CursoController@update`, que impide actualizar la fecha de inicio de un curso.
- `fecha_nacimiento` se guarda como texto en `alumnos` y `gestores`.
- Migración heredada `create_password_resets_table` duplicada respecto a `password_reset_tokens`.
- Listados sin `orderBy` explícito; en PostgreSQL el orden de `Model::all()` no está garantizado.
- Los correos no se normalizan a minúsculas; PostgreSQL distingue mayúsculas al comparar.
- El botón de pantalla completa del panel se retiró porque el navegador cancela ese modo al cambiar de página. Se puede usar la pantalla completa del navegador.
