# Análisis de la Base de Datos: `u868517925_ncie`

La base de datos está diseñada sobre el framework Laravel y utiliza el paquete **Spatie Laravel Permission** para la gestión de roles. A continuación, se detallan los componentes principales:

## 👤 Gestión de Usuarios y Roles

- **`users`**: Tabla central de autenticación.
- **Roles principales**:
    - `admin`: Acceso total.
    - `administrativo`: Gestión operativa.
    - `gestor`: Instructores/Asesores.
    - `alumno`: Estudiantes.
- **Perfiles Extendidos**:
    - `alumnos`: Datos académicos (Número de control, semestre, carrera).
    - `administrativos`: Datos del personal administrativo.
    - `gestores`: Datos de instructores (Grado académico, carrera).

## 📚 Contenido Académico y Proyectos

- **`cursos`**: Gestión de capacitaciones (Fechas, horarios, modalidad, lugar).
- **`proyectos`**: Registro de proyectos con soporte para fotos.
- **`areas`**: Categorización tecnológica (ej. IOT, Vectores de tecnología).
- **`horarios`**: Disponibilidad de gestores por área.

## 🔗 Relaciones Clave

- **`inscripciones`**: Estudiantes inscritos en cursos.
- **`alumno_proyecto`**: Vinculación de alumnos con proyectos (Residencias, Servicio Social, Propio).
- **`gestor_curso` / `gestor_proyecto`**: Asignación de responsables a los contenidos.

## 💰 Otros Módulos

- **`presupuestos`**: Seguimiento financiero simple (Motivo, monto, fecha).
- **`posts`**: Sistema de avisos o publicaciones.
- **`notifications`**: Registro de alertas del sistema para los usuarios.

## 🛠 Datos de Interés

- La codificación es `utf8mb4_unicode_ci`.
- Las relaciones tienen restricciones `ON DELETE CASCADE` en su mayoría, lo que mantiene la integridad referencial al eliminar usuarios o cursos.
- El usuario administrador principal es `sistemancie@gmail.com`.
