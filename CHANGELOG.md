# Historial de versiones

Todos los cambios relevantes del Sistema NCIE. El formato sigue [Keep a Changelog](https://keepachangelog.com/es/1.1.0/) y el versionado es [SemVer](https://semver.org/lang/es/): mayor.menor.corrección.

## [2.0.0] - 2026-09-11

Versión final del ciclo de desarrollo 2026.

### Añadido
- `composer.json` declara la versión del proyecto.
- README con la versión final y enlaces a toda la documentación.

### Cambiado
- Cierre del historial de versiones.

## [1.9.1] - 2026-09-11

### Añadido
- `CHANGELOG.md` con el historial de versiones desde la base del sistema.

## [1.9.0] - 2026-09-11

### Cambiado
- `INFO.md` reescrito para la versión 2.0: módulos actuales, roles, estado del proyecto y pendientes.
- `DOCUMENTACION.md` reescrita: entorno Docker vigente, configuración, verificación configurable, sitio público, acceso, panel, calidad y compatibilidad con PostgreSQL. Sin credenciales de servicios.

## [1.8.1] - 2026-09-10

### Añadido
- `README.md` para GitHub: descripción, arranque rápido con Docker, cuentas de demostración, servicios, estructura y enlaces a la documentación.

## [1.8.0] - 2026-09-10

### Añadido
- `BD_DIAGRAMA.md`: diagrama entidad-relación en Mermaid y diccionario de las 25 tablas de PostgreSQL, con claves, referencias, índices únicos, restricciones y comandos de respaldo.

### Cambiado
- `database/DATABASE.md` remite al nuevo diccionario.

## [1.7.1] - 2026-09-09

### Corregido
- Integración continua en PHP 8.2, que es lo que exige `composer.lock`; con 8.1 la instalación de dependencias fallaba.

### Cambiado
- `.env.example` con el nombre del sistema y el interruptor de verificación de correo.

## [1.7.0] - 2026-09-09

### Añadido
- `config/ncie.php` con `email_verification`, controlado por `NCIE_EMAIL_VERIFICATION`.

### Cambiado
- Con la verificación desactivada, el registro marca la cuenta como verificada, no envía correo y entra directo al panel. Los textos del sitio que mencionaban la verificación se muestran solo cuando está activa.
- `.env.docker` incluye `NCIE_EMAIL_VERIFICATION=false`.

### Corregido
- El registro devolvía error 500 cuando el servidor SMTP rechazaba la conexión.

## [1.6.1] - 2026-09-08

### Cambiado
- Pantallas de recuperar contraseña, restablecer, confirmar contraseña, verificar correo y cuenta creada sobre el nuevo layout de acceso, con indicador de pasos y acciones claras.

## [1.6.0] - 2026-09-08

### Añadido
- `layouts/auth.blade.php`: acceso a pantalla completa dividida, con imagen lateral, tema de color por pantalla y formulario con más aire.

### Cambiado
- Iniciar sesión en azul con la imagen a la izquierda; crear cuenta en rojo con la imagen a la derecha y las contraseñas en una fila. Términos y condiciones en un diálogo nativo.

## [1.5.1] - 2026-09-08

### Cambiado
- Landing reescrita sin Bootstrap ni Medilab: menú en isla de vidrio con progreso de lectura, portada, dos formas de participar, el nodo con video integrado y ficha de datos, áreas desde la base de datos, atención de gestores con selector y tabla, proyectos con área y gestor, galería, contacto y preguntas frecuentes.
- Fondo con cuatro escenas de color que cambian según la sección visible.
- `WebController` entrega los proyectos con sus gestores y áreas, y el parcial del horario responde con `Content-Length` explícito.

### Corregido
- El horario de gestores podía quedarse en "Cargando" por respuestas fuera de orden; ahora descarta respuestas tardías, aborta a los 6 segundos y reintenta.

## [1.5.0] - 2026-09-08

### Añadido
- `public/assets/css/ncie.css`: sistema visual "laboratorio nocturno" para el sitio público y el acceso. Fondo negro azulado con auroras rojas y azules, superficies de vidrio, radios grandes y tipografía Archivo.

## [1.4.1] - 2026-08-28

### Corregido
- `POST /mark-as-read` apuntaba al controlador con la sintaxis antigua y fallaba en Laravel 10; se eliminó además la importación a un controlador inexistente.

### Cambiado
- Crear aviso en un solo formulario con selector de destinatarios.
- Bandeja de notificaciones con contador, marcar leída una a una o todas por AJAX, actualización de la campana e historial de las últimas 30 leídas.

## [1.4.0] - 2026-08-28

### Añadido
- `ncie-landing.css` y `ncie-auth.css`: primera capa de diseño propia sobre la plantilla Medilab para la landing y las pantallas de acceso.

## [1.3.1] - 2026-08-27

### Corregido
- Clase `form-group` mal escrita en los formularios de usuarios, administrativos, alumnos, áreas, gestores, horarios, cursos, proyectos, presupuestos, asignaciones, proyectos a gestores e inscripciones, que rompía el espaciado de los campos.

## [1.3.0] - 2026-08-27

### Cambiado
- Dashboard del panel: banner de bienvenida, resumen de totales en tarjetas compactas y calendario de cursos con detalle en ventana modal.

## [1.2.1] - 2026-08-27

### Añadido
- `public/dist/css/ncie-admin.css`: tema del panel sobre AdminLTE 3 (paleta, tipografía Archivo, tarjetas, tablas, formularios, barra lateral con degradado, barra superior fija).

### Cambiado
- Layout del panel con menú lateral plano agrupado por Personas, Académico, Proyectos, Mi espacio y Comunicación; menú que recuerda si está plegado; cerrar sesión al pie.

## [1.2.0] - 2026-08-27

### Añadido
- `DemoSeeder`: áreas, gestores con horario, administrativos, alumnos, usuarios externos, cursos relativos a la fecha de ejecución, inscripciones, proyectos con foto, presupuestos, avisos y notificaciones. Copia las fotos de demostración desde la galería pública.

### Cambiado
- `DatabaseSeeder` crea al administrador con el correo ya verificado.

## [1.1.1] - 2026-08-25

### Añadido
- `INFO.md` con el análisis funcional del sistema y `DOCUMENTACION.md` con la guía de arranque en Docker y los hallazgos de compatibilidad con PostgreSQL.

## [1.1.0] - 2026-08-25

### Añadido
- Entorno Docker propio: `docker-compose.yml` con NGINX, PHP-FPM 8.2, PostgreSQL 16 y Node bajo demanda; `docker/php/Dockerfile`, `docker/nginx/default.conf` y plantilla `.env.docker`.

### Eliminado
- `docker-compose.yml` de Laravel Sail con MySQL, Redis y Mailpit.

## [1.0.1] - 2026-08-25

### Eliminado
- Archivos `._*` y `.DS_Store` de macOS, `default1.php` del hosting anterior y fotos de prueba en `public/uploads/fotos`.

### Cambiado
- `.gitignore` excluye documentos internos (`manuales/`, `Bitacoras/`, `SKILL.md`), respaldos de `.env` y el directorio de subidas.

## [1.0.0] - 2026-04-17

### Añadido
- Base del sistema: Laravel 10 con laravel/ui y Spatie Permission, panel sobre AdminLTE 3, landing sobre Medilab, integración continua con PHPStan y PHPUnit.

[2.0.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.9.1...v2.0.0
[1.9.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.9.0...v1.9.1
[1.9.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.8.1...v1.9.0
[1.8.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.8.0...v1.8.1
[1.8.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.7.1...v1.8.0
[1.7.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.7.0...v1.7.1
[1.7.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.6.1...v1.7.0
[1.6.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.6.0...v1.6.1
[1.6.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.5.1...v1.6.0
[1.5.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.5.0...v1.5.1
[1.5.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.4.1...v1.5.0
[1.4.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.4.0...v1.4.1
[1.4.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.3.1...v1.4.0
[1.3.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.2.1...v1.3.0
[1.2.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.2.0...v1.2.1
[1.2.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.1.1...v1.2.0
[1.1.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.1.0...v1.1.1
[1.1.0]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.0.1...v1.1.0
[1.0.1]: https://github.com/Joshua-Velasco/NCIEPortal/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/Joshua-Velasco/NCIEPortal/releases/tag/v1.0.0
