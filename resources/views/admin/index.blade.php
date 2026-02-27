@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h1><b>Bienvenido/a:</b> {{ Auth::user()->email }} / <b>Rol:</b> {{Auth::user()->roles->pluck('name')->first()}}</h1>
        </div>
    </div>

    <hr>

    <!-- Tarjetas de resumen -->
    <div class="row mb-4">
        @can('admin.usuarios.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_usuarios}}</h3>
                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-file-person"></i>
                </div>
                <a href="{{url('admin/usuarios')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.administracion.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$total_administrativos}}</h3>
                    <p>Administrativos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-person-circle"></i>
                </div>
                <a href="{{url('admin/administracion')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.alumnos.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$total_alumnos}}</h3>
                    <p>Alumnos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-person-add"></i>
                </div>
                <a href="{{url('admin/alumnos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.areas.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total_areas}}</h3>
                    <p>Áreas</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-building-add"></i>
                </div>
                <a href="{{url('admin/areas')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.gestores.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$total_gestores}}</h3>
                    <p>Gestores</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-person-lines-fill"></i>
                </div>
                <a href="{{url('admin/gestores')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.horarios.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$total_horarios}}</h3>
                    <p>Horarios</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-calendar2-week"></i>
                </div>
                <a href="{{url('admin/horarios')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.cursos.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$total_cursos}}</h3>
                    <p>Cursos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-clipboard2-check"></i>
                </div>
                <a href="{{url('admin/cursos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.proyectos.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$total_proyectos}}</h3>
                    <p>Proyectos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-book"></i>
                </div>
                <a href="{{url('admin/proyectos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('admin.asignaciones.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$total_aignaciones}}</h3>
                    <p>Asignación de Cursos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-clipboard2-minus-fill"></i>
                </div>
                <a href="{{url('admin/asignaciones')}}" class="small-box-footer">Mas información<i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

         @can('admin.proyecto_gestores.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$total_gestores_proyectos}}</h3>
                    <p>Proyectos a gestores</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-journal-check"></i>
                </div>
                <a href="{{url('admin/proyecto_gestores')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan
    

         @can('admin.alumno_proyecto.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$total_alumnos_proyectos}}</h3>
                    <p>Proyectos a alumnos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-journal-plus"></i>
                </div>
                <a href="{{url('admin/alumno_proyecto')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

         @can('admin.presupuestos.index')
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{$total_presupuestos}}</h3>
                    <p>Presupuestos</p>
                </div>
                <div class="icon">
                    <i class="fas bi bi-coin"></i>
                </div>
                <a href="{{url('admin/presupuestos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('inscripciones.mis-cursos')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <br>
                    <p>Mis cursos</p>
                     <br>
                </div>
                <div class="icon">
                    <i class="fas bi bi-clipboard2-check"></i>
                </div>
                <a href="{{route('inscripciones.mis-cursos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('inscripciones.mis_proyectos')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <br>
                    <p>Mis proyectos</p>
                    <br>
                </div>
                <div class="icon">
                    <i class="fas bi bi-book"></i>
                </div>
                <a href="{{route('inscripciones.mis_proyectos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('reportes.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <br>
                    <p>Mis cursos</p>
                    <br>
                </div>
                <div class="icon">
                    <i class="fas bi bi-clipboard2-check"></i>
                </div>
                <a href="{{route('reportes.cursos-asignados')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

         @can('reportes.index')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <br>
                    <p>Usuarios inscritos a mis <br> cursos</p>
                    
                </div>
                <div class="icon">
                    <i class="fas bi bi-file-person"></i>
                </div>
                <a href="{{route('reportes.index')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

        @can('reportes.mis_proyectos')
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <br>
                    <p>Mis proyectos</p>
                    <br>
                </div>
                <div class="icon">
                    <i class="fas bi bi-book"></i>
                </div>
                <a href="{{route('reportes.mis_proyectos')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
        @endcan

      
           <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <br>
                    <p>Mis notificaciones</p>
                    <br>
                </div>
                <div class="icon">
                    <i class="fas fas fa-users"></i>
                </div>
                <a href="{{route('post.notifications')}}" class="small-box-footer">Mas información <i class="fas bi bi-info-square"></i></a>
            </div>
        </div>
     

    </div>

    @can('inscripciones.mis-cursos')
    <!-- Calendario -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Calendario de cursos del nodo</h3>
                    <br> <br>
                    <a href="{{ route('inscripciones.create') }}" class="btn btn-primary">
    Registrarse a un curso
</a>
                </div>  
               
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para detalles del curso -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detalles del Curso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Fecha:</strong> <span id="eventDate"></span></p>
                    <p><strong>Horario:</strong> <span id="eventTime"></span></p>
                    <p><strong>Lugar:</strong> <span id="eventLocation"></span></p>
                    <p><strong>Modalidad:</strong> <span id="eventModality"></span></p>
                    <p><strong>Requisitos:</strong> <span id="eventRequirements"></span></p>
                    <p><strong>Descripción:</strong> <span id="eventDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: {
    url: '{{ route("admin.cursos.calendar-events") }}', // Usa el helper de route
    method: 'GET',
    failure: function(error) {
        console.error('Error:', error);
        alert('Error al cargar eventos. Verifica la consola (F12 > Console)');
    }
},
            eventClick: function(info) {
                var titleParts = info.event.title.split(' (');
                var courseName = titleParts[0];
                var schedule = titleParts[1] ? titleParts[1].replace(')', '') : 'Horario no especificado';
                
                var startDate = new Date(info.event.start);
                var endDate = info.event.end ? new Date(info.event.end) : startDate;
                endDate.setDate(endDate.getDate() - 1);
                
                var dateStr = startDate.toLocaleDateString('es-ES');
                if (startDate.getTime() !== endDate.getTime()) {
                    dateStr += ' al ' + endDate.toLocaleDateString('es-ES');
                }
                
                $('#eventTitle').text(courseName);
                $('#eventDate').text(dateStr);
                $('#eventTime').text(schedule);
                $('#eventLocation').text(info.event.extendedProps?.lugar || 'No especificado');
                $('#eventModality').text(info.event.extendedProps?.modalidad || 'No especificado');
               var requisitos = info.event.extendedProps?.requisitos;
                $('#eventRequirements').text(requisitos && requisitos.trim() !== '' ? requisitos : 'No hay requisitos para este curso');
                $('#eventDescription').text(info.event.extendedProps?.descripcion || 'No hay descripción disponible');
                
                $('#eventModal').modal('show');
                
                info.jsEvent.preventDefault();
            },
            eventDidMount: function(info) {
                $(info.el).tooltip({
                    title: info.event.title,
                    placement: 'top',
                    container: 'body'
                });
            }
        });
        
        calendar.render();
    }
});
</script>
@endsection