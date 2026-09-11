# Sistema NCIE

Plataforma web del **Nodo de Creatividad, Innovación y Emprendimiento (NCIE)** del Instituto Tecnológico de Ciudad Juárez (TecNM). Reúne un sitio público para la comunidad y un panel interno para administrar el nodo: personas, áreas, horarios de atención, cursos con calendario e inscripciones, proyectos, presupuestos y avisos.

**Versión:** 2.0.0 · **Stack:** Laravel 10, PHP 8.2, PostgreSQL 16, Docker · **Idioma:** español

---

## Qué incluye

**Sitio público** (`/`)
- Portada con las dos formas de participar: tomar un curso o unirse a un proyecto.
- Video del nodo integrado y ficha con fundación, modelo, áreas y ubicación.
- Áreas del nodo leídas de la base de datos, con icono propio por área.
- Horario de atención de gestores por área, con el día de hoy marcado.
- Tabla de proyectos en curso con su área y gestor responsable.
- Galería, contacto con mapa y buzón de sugerencias, y preguntas frecuentes.
- Fondo que cambia de escena de color mientras se recorre la página.

**Acceso** (`/login`, `/register`)
- Pantallas a pantalla completa con imagen lateral; iniciar sesión en azul y crear cuenta en rojo.
- Verificación de correo opcional, controlada por configuración.

**Panel** (`/admin`)
- Menú lateral agrupado por Personas, Académico, Proyectos, Mi espacio y Comunicación, filtrado por rol.
- Dashboard con resumen y calendario de cursos.
- Altas, bajas y cambios de usuarios, administrativos, gestores, alumnos, áreas, horarios, cursos, asignaciones, proyectos y presupuestos.
- Inscripciones a cursos con validación de choques de horario.
- Avisos a la comunidad con notificaciones por rol, marcado de leídas e historial.

## Arranque rápido con Docker

Requisitos: Docker Desktop (Compose v2). No hace falta PHP, Composer ni Node en la máquina.

```bash
git clone https://github.com/Joshua-Velasco/NCIEPortal.git
cd NCIEPortal

cp .env.docker .env
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
docker compose exec app php artisan db:seed --class=DemoSeeder
docker compose --profile assets run --rm node
```

Abre **http://localhost:8080**. El panel está en **http://localhost:8080/login**.

Arranque diario después de apagar la máquina:

```bash
docker compose up -d
```

## Cuentas de demostración

Las siembra `DemoSeeder`. Contraseña para todas: `12345678`.

| Rol | Correo |
|---|---|
| Admin | `sistemancie@gmail.com` |
| Administrativo | `admin.ncie1@itcj.edu.mx` (también `admin.ncie2`, `admin.ncie3`) |
| Gestor | `gestor1@itcj.edu.mx` … `gestor7@itcj.edu.mx` |
| Alumno | `l21110001@cdjuarez.tecnm.mx` … `l21110012@cdjuarez.tecnm.mx` |
| Usuario de la comunidad | `laura.beltran@gmail.com` |

Volver a ejecutar `DemoSeeder` borra los datos del dominio y todos los usuarios que no sean admin antes de sembrar de nuevo.

## Servicios de Docker

| Servicio | Imagen | Puerto | Función |
|---|---|---|---|
| `nginx` | nginx:1.27-alpine | 8080 | Servidor web |
| `app` | php:8.2-fpm-alpine (Dockerfile propio) | interno 9000 | Laravel |
| `db` | postgres:16-alpine | 5432 | Base de datos `ncie` |
| `node` | node:20-alpine (perfil `assets`) | — | Compila los assets de Vite bajo demanda |

## Documentación

| Archivo | Contenido |
|---|---|
| [INFO.md](INFO.md) | Qué es el sistema, roles, módulos y estado del proyecto |
| [DOCUMENTACION.md](DOCUMENTACION.md) | Guía técnica: entorno, configuración, panel, sitio público, solución de problemas |
| [BD_DIAGRAMA.md](BD_DIAGRAMA.md) | Diagrama entidad-relación y diccionario de datos de PostgreSQL |
| [CHANGELOG.md](CHANGELOG.md) | Historial de versiones |

## Estructura

```
app/            Controladores, modelos, eventos, listeners, notificaciones y correo
config/ncie.php Interruptores propios del sistema (verificación de correo)
database/       Migraciones y seeders (RoleSeeder, DatabaseSeeder, DemoSeeder)
docker/         Dockerfile de PHP-FPM y configuración de NGINX
public/assets/  Sitio público (ncie.css, iconos, imágenes, galería)
public/dist/    AdminLTE 3 y tema del panel (ncie-admin.css)
resources/views/ Vistas Blade: index (landing), auth/, layouts/, admin/, post/, inscripciones/, reportes/
routes/web.php  Rutas; cada una protegida con auth, verified y su permiso
tests/          Pruebas de humo (PHPUnit)
```

## Calidad

- `php artisan test` ejecuta las pruebas de PHPUnit.
- `vendor/bin/phpstan analyze` corre el análisis estático en nivel 5.
- GitHub Actions ejecuta ambos en cada push a `main` o `develop`.

## Créditos

Desarrollado para el NCIE del Instituto Tecnológico de Ciudad Juárez. Interfaz sobre Laravel, AdminLTE 3 y Bootstrap Icons; tipografía Archivo.
