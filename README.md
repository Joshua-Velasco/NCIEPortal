# NCIEPortal

NCIEPortal es una plataforma de gestión diseñada para el NCIE (Núcleo de Capacitación e Innovación Empresarial). Este portal facilita la administración de cursos, proyectos, usuarios e inscripciones, permitiendo una interacción fluida entre administradores, instructores y estudiantes.

## 🚀 Inicio Rápido e Instalación

Para poner en marcha el proyecto localmente, sigue estos pasos:

1. **Requisitos Previos**:
    - PHP >= 8.1
    - Composer
    - XAMPP o un servidor local compatible con MySQL.
    - Node.js y NPM.

2. **Instalación**:

    ```bash
    # Clonar el repositorio (si no lo has hecho)
    git clone https://github.com/NCIE-2026/NCIEPortal.git

    # Entrar al directorio
    cd NCIEPortal

    # Instalar dependencias de PHP
    composer install

    # Instalar dependencias de JS
    npm install

    # Copiar el archivo de entorno
    cp .env.example .env

    # Generar la clave de la aplicación
    php artisan key:generate
    ```

3. **Configuración de Base de Datos**:
    - Crea una base de datos en MySQL (ej. `ncie_portal`).
    - Configura las credenciales en tu archivo `.env`.
    - Ejecuta las migraciones y seeders:
        ```bash
        php artisan migrate --seed
        ```

4. **Ejecutar el Proyecto**:

    ```bash
    # Servidor de desarrollo
    php artisan serve

    # Compilar assets
    npm run dev
    ```

## 🐳 Despliegue con Docker (Recomendado para Testers)

Si tienes Docker instalado, puedes levantar el proyecto sin configurar PHP o MySQL manualmente:

1. **Levantar contenedores**:
   ```bash
   ./vendor/bin/sail up -d
   ```
2. **Instalar dependencias y migrar** (solo la primera vez):
   ```bash
   ./vendor/bin/sail composer install
   ```
3. **Migrar base de datos**:
   ```bash
   ./vendor/bin/sail artisan migrate --seed
   ```
4. **Acceso**: El sistema estará disponible en `http://localhost`.

## 🧪 Pruebas y Calidad

Para asegurar la calidad del código, el proyecto utiliza:

- **PHPUnit**: Para pruebas funcionales. Ejecuta `./vendor/bin/sail test`.
- **PHPStan**: Análisis estático de errores. Ejecuta `./vendor/bin/sail bin phpstan analyze`.
- **GitHub Actions**: Cada commit a `main` o `develop` activa automáticamente estas pruebas.

## 🔑 Credenciales de Acceso

Para acceder al portal administrativo durante el desarrollo, utiliza las siguientes credenciales:

- **Email:** `sistemancie@gmail.com`
- **Password:** `123456789`

## 📁 Estructura del Proyecto

- `app/`: Contiene la lógica central (Modelos, Controladores, Mailers).
- `database/`: Migraciones y seeders para la base de datos.
- `resources/views/`: Plantillas Blade para la interfaz de usuario.
- `routes/`: Definición de rutas web y de API.

---

© 2026 NCIE. Todos los derechos reservados.
