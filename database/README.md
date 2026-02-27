# Directorio Database

Gestión de la estructura y datos iniciales de la base de datos.

## 📁 Estructura

- **`migrations/`**: Archivos que definen la estructura de las tablas. Permiten el control de versiones de la base de datos.
- **`seeders/`**: Clases para poblar la base de datos con datos de prueba o iniciales (como el usuario administrador por defecto).
- **`factories/`**: Generadores de datos aleatorios para pruebas.

## 🛠 Comandos Útiles

```bash
# Ejecutar migraciones pendientes
php artisan migrate

# Refrescar base de datos y sembrar datos
php artisan migrate:fresh --seed
```
