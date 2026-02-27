# Directorio App

Esta carpeta contiene la lógica central de la aplicación Laravel.

## 📁 Estructura

- **`Console/`**: Comandos personalizados de Artisan.
- **`Http/`**:
    - **`Controllers/`**: Controladores que manejan las solicitudes HTTP (Admin, Instructor, Estudiante).
    - **`Middleware/`**: Filtros para las peticiones (Autenticación, Permisos).
- **`Models/`**: Clases de Eloquent que representan las tablas de la base de datos (Usuario, Curso, Proyecto, etc.).
- **`Mail/`**: Clases para el envío de correos electrónicos (ej. Sugerencias).
- **`Notifications/`**: Notificaciones del sistema.
- **`Providers/`**: Proveedores de servicios del framework.

## 💡 Notas para Desarrolladores

- Siempre usa los modelos de Eloquent para interactuar con la base de datos.
- Los controladores deben mantenerse lo más limpios posible, delegando lógica compleja a servicios o modelos.
