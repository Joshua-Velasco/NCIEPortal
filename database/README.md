# Base de Datos (NCIEPortal)

Esta carpeta gestiona la persistencia de datos, la estructura de las tablas y el llenado de información inicial mediante herramientas de Laravel.

## 📁 Estructura del Directorio

| Carpeta | Propósito |
| :--- | :--- |
| **migrations/** | Control de versiones de la base de datos. Cada archivo define la creación o modificación de una tabla. |
| **seeders/** | Clases encargadas de poblar las tablas con datos base (roles, administrador por defecto) o de prueba. |
| **factories/** | Generadores de datos aleatorios utilizados habitualmente junto con los seeders para pruebas masivas. |

## 🛠 Comandos de Gestión

Para inicializar la base de datos desde cero, utiliza:
```bash
php artisan migrate:fresh --seed
```

O para aplicar solo cambios nuevos:
```bash
php artisan migrate
```

## 📝 Notas Adicionales
- Existe un respaldo físico de la base de datos en la raíz del proyecto: `u868517925_ncie.sql`.
- El esquema de permisos está integrado dentro de las migraciones y seeders (utilizando el sistema de capacidades de Laravel).
