# Controladores del Sistema (NCIEPortal)

Esta carpeta contiene la lógica de negocio que procesa las solicitudes entrantes, interactúa con los modelos y retorna las respuestas (vistas o datos).

## Listado de Controladores Principales

| Archivo | Responsabilidad |
| :--- | :--- |
| **AdminController.php** | Gestiona el dashboard de administración y estadísticas generales. |
| **UsuarioController.php** | CRUD (Creación, Lectura, Actualización, Eliminación) de usuarios y asignación de roles. |
| **AlumnoController.php** | Gestión de los datos específicos de los estudiantes. |
| **GestorController.php** | Gestión de los instructores y encargados de capacitación. |
| **CursoController.php** | Administración del catálogo de cursos y calendario de eventos. |
| **ProyectoController.php** | Creación y seguimiento de proyectos de innovación. |
| **AsignacionController.php** | Lógica para vincular gestores con cursos, incluyendo validación de horarios. |
| **InscripcionController.php** | Proceso de registro de alumnos en cursos y gestión de "Mis Cursos". |
| **AlumnoProyecto.php** | Gestión de las asignaciones de estudiantes a proyectos. |
| **ProyectoGestorController.php** | Gestión de los instructores responsables de cada proyecto. |
| **HorarioController.php** | Configuración de horarios por áreas y cursos. |
| **AreaController.php** | Administración de departamentos o áreas temáticas. |
| **PresupuestoController.php**| Control de ingresos y egresos vinculados a actividades. |
| **ReporteController.php** | Generación de reportes de asistencia y desempeño. |
| **SugerenciaController.php**| Manejo del buzón de sugerencias y envío de correos electrónicos. |
| **PostController.php** | Gestión de avisos y notificaciones en el portal. |
| **WebController.php** | Control de la parte pública del sitio e inicio. |

## Estructura de Métodos Estándar
La mayoría de los controladores CRUD utilizan los siguientes métodos:
- `index()`: Lista los registros.
- `create()` / `store()`: Formularios y guardado de nuevos datos.
- `edit()` / `update()`: Modificación de registros existentes.
- `show()`: Visualización detallada.
- `destroy()`: Eliminación de registros.
