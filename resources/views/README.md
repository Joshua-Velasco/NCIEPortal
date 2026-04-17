# Vistas del Sistema (NCIEPortal)

Esta carpeta contiene las plantillas Blade (.blade.php) que definen la interfaz de usuario. Laravel compila estas plantillas en código PHP plano para mejorar el rendimiento.

## Estructura de Carpetas

| Carpeta | Propósito |
| :--- | :--- |
| **layouts/** | Contiene la estructura base (HTML, metadatos, scripts) que se hereda en otras vistas. Suele incluir `app.blade.php`. |
| **admin/** | Vistas del panel administrativo, organizadas por módulo (usuarios, cursos, gestores, etc.). |
| **auth/** | Plantillas para el inicio de sesión, registro, recuperación de contraseña y verificación de email. |
| **inscripciones/** | Interfaz para que los estudiantes se registren en los cursos y vean sus inscripciones actuales. |
| **reportes/** | Generación de visualizaciones y tablas para instructores y administración. |
| **emails/** | Plantillas para los correos electrónicos enviados por el sistema (ej: sugerencias recibidas). |
| **post/** | Vistas para la gestión y visualización de avisos/notificaciones. |
| **vendor/** | Vistas de paquetes de terceros (como la paginación de Laravel) que han sido publicadas para personalización. |

## Archivos en la Raíz
- **index.blade.php**: La página de bienvenida pública del portal.
- **home.blade.php**: El dashboard inicial para usuarios autenticados.
- **welcome.blade.php**: Página por defecto de Laravel (posiblemente de referencia).

## Tecnologías Utilizadas
- **Blade**: Motor de plantillas de Laravel.
- **Vite**: Se utiliza para compilar los assets (CSS y JS) referenciados mediante `@vite(['resources/css/app.css', 'resources/js/app.js'])`.
