# Modelos del Sistema (NCIEPortal)

Esta carpeta contiene las clases Eloquent que representan las entidades de datos del sistema y sus relaciones.

## Listado de Modelos

| Archivo | Descripción |
| :--- | :--- |
| **User.php** | Modelo principal de autenticación. Gestiona los datos de acceso para todos los roles. |
| **Administrativo.php** | Representa al personal administrativo del NCIE. |
| **Alumno.php** | Gestiona la información de perfil de los estudiantes. |
| **AlumnoProyecto.php** | Tabla pivote que vincula a los alumnos con proyectos específicos. |
| **Area.php** | Departamentos o áreas de especialidad (ej: Innovación, Capacitación). |
| **Curso.php** | Define los cursos ofrecidos, incluyendo fechas, costos y cupos. |
| **Gestor.php** | Representa a los instructores o encargados de proyectos/cursos. |
| **GestorCurso.php** | Vincula a los gestores con los cursos que imparten. |
| **GestorProyecto.php** | Vincula a los gestores con los proyectos que supervisan. |
| **Horario.php** | Define los bloques de tiempo asignados a cursos o actividades. |
| **Inscripcion.php** | Gestiona el registro de alumnos en cursos y su estatus. |
| **Post.php** | Modelo para noticias, avisos o publicaciones del portal. |
| **Presupuesto.php** | Manejo de datos financieros y presupuestarios del centro. |
| **Proyecto.php** | Gestión de proyectos de innovación y desarrollo empresarial. |

## Relaciones Principales
- Un **User** tiene un perfil de **Alumno**, **Gestor** o **Administrativo**.
- Un **Curso** tiene múltiples **Inscripciones** y **Horarios**.
- Un **Proyecto** puede tener varios **Alumnos** y **Gestores** asignados.
