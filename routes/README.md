# Rutas del Sistema (NCIEPortal)

Esta carpeta define todos los puntos de acceso (URLs) del sistema y los vincula con sus controladores correspondientes.

## Archivos de Rutas

| Archivo | Función |
| :--- | :--- |
| **web.php** | Contiene la gran mayoría de las rutas del sistema. Están protegidas por el middleware `web` (soporte de sesiones, cookies y CSRF). |
| **api.php** | (Opcional) Reservado para rutas de API si se desea conectar aplicaciones móviles o servicios externos. |
| **console.php** | Define comandos personalizados para la consola de Artisan. |
| **channels.php** | Configuración de canales de difusión para eventos en tiempo real (Broadcasting). |

## Grupos y Seguridad en `web.php`
Las rutas en este proyecto están organizadas por:
- **Públicas**: Inicio y autenticación básica.
- **Protegidas (`auth`, `verified`)**: Requieren que el usuario haya iniciado sesión y verificado su correo.
- **Por Roles (`can:permisson`)**: Utilizan el sistema de permisos para restringir el acceso a módulos específicos (ej: solo administradores pueden ver `/admin/usuarios`).

### Referencia de Prefijos
- `/admin/*`: Rutas para gestión administrativa.
- `/inscripciones/*`: Registro de alumnos.
- `/reportes/*`: Visualización de datos por gestores.
