<!-- Plantilla -->
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema NCIE</title>
  
   <link href="{{url('dist/img/logo.png')}}" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">

  <!-- Iconos de bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <!-- jQuery -->
  <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>

  <!-- Sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

  <!-- fullcalendar -->
   <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>
   <script src="{{url('fullcalendar/es.global.js')}}"></script>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin')}}" class="nav-link">Sistema NCIE</a>
      </li>
    </ul>

  
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
        
            @if (count(auth()->user()->unreadNotifications))
            <span class="badge badge-warning">{{count(auth()->user()->unreadNotifications)}}</span>
            @endif
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
  <span class="dropdown-header">Notificaciones no leídas</span>
  <div id="unread-notifications" class="notification-container">
    @forelse (auth()->user()->unreadNotifications as $notification)
         <a href="{{route('post.notifications')}}" class="dropdown-item">
      <i class="fas fa-envelope mr-2"></i> {{$notification->data['title']}}
      <span class="ml-3 float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
    </a>
     @empty
     <span class="ml-3 float-left text-muted text-sm">Sin notificaciones por leer</span>
    @endforelse
  </div>
  
  <div class="dropdown-divider"></div>
  <span class="dropdown-header">Notificaciones leídas</span>
  <div id="read-notifications" class="notification-container">
    @forelse (auth()->user()->readNotifications as $notification)
        <a href="#" class="dropdown-item">
      <i class="fas fa-users mr-2"></i>    
      <span title="{{$notification->data['description']}}">
          {{ Str::limit($notification->data['description'], 30) }}
      </span>
      <span class="ml-3 float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
    </a>
    @empty
         <span class="ml-3 float-left text-muted text-sm">Sin notificaciones leídas</span>
    @endforelse
  </div>
  
  <div class="dropdown-divider"></div>
  <a href="{{route('markAsRead')}}" class="dropdown-item dropdown-footer">Marcar leídas</a>
</div>
    </li>
 
     
     <style>
.notification-container {
  max-height: none;
  overflow-y: hidden;
}
.notification-container.scroll-active {
  max-height: 200px;
  overflow-y: auto;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Para notificaciones no leídas
  const unreadContainer = document.getElementById('unread-notifications');
  const unreadItems = unreadContainer.querySelectorAll('.dropdown-item');
  if (unreadItems.length > 3) {
    unreadContainer.classList.add('scroll-active');
  }

  // Para notificaciones leídas
  const readContainer = document.getElementById('read-notifications');
  const readItems = readContainer.querySelectorAll('.dropdown-item');
  if (readItems.length > 3) {
    readContainer.classList.add('scroll-active');
  }
});
</script>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('')}}" class="brand-link">
      <img src="{{url('dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">NCIE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
          <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" class="img-circle elevation-2">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('admin.usuarios.index')     
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-people-fill"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/usuarios/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de usuarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/usuarios')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de usuarios</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

   @can('admin.administracion.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-circle"></i>
              <p>
                Administrativos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/administracion/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de administrativos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/administracion')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de administrativos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

            @can('admin.alumnos.index')
            <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-add"></i>
              <p>
                Alumnos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/alumnos/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de alumnos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/alumnos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de alumnos</p>
                </a>
              </li>
            </ul>
          </li>
           @endcan


            @can('admin.areas.index')
           <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-building-add"></i>
              <p>
                Áreas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/areas/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de áreas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/areas')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de áreas</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan


           @can('admin.gestores.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-person-lines-fill"></i>
              <p>
                Gestores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/gestores/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de gestores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/gestores')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de gestores</p>
                </a>
              </li>
            </ul>
          </li>
            @endcan

          @can('admin.horarios.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-calendar2-week"></i>
              <p>
                Horarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/horarios/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de horarios</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/horarios')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de horarios</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan


          @can('admin.cursos.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-clipboard2-check"></i>
              <p>
                Cursos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/cursos/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de cursos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/cursos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de cursos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('admin.proyectos.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-book"></i>
              <p>
                Proyectos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/proyectos/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de proyectos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/proyectos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de proyectos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('admin.asignaciones.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-clipboard2-minus-fill"></i>
              <p>
                Asignación de Cursos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/asignaciones/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de Asignación</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/asignaciones')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Asignaciones</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

           @can('inscripciones.mis-cursos')
           <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-clipboard2-check"></i>
              <p>
                Mis cursos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('inscripciones.mis-cursos') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de mis cursos</p>
                </a>
              </li>
            </ul>
          </li>
           @endcan

            @can('reportes.index')
            <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-clipboard2-check"></i>
              <p>
                Mis cursos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reportes.cursos-asignados')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de mis cursos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('reportes.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de inscriciones</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

            @can('admin.proyecto_gestores.index')
             <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-journal-check"></i>
              <p>
                Proyectos a gestores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/proyecto_gestores/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de Asignación proyectos a gestores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/proyecto_gestores')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Asignaciones</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('admin.alumno_proyecto.index')
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-journal-plus"></i>
              <p>
                Proyectos a alumnos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/alumno_proyecto/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de Asignación proyectos a alumnos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/alumno_proyecto')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de Asignaciones</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('reportes.mis_proyectos')
            <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-book"></i>
              <p>
                Mis proyectos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reportes.mis_proyectos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de mis proyectos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

          @can('inscripciones.mis_proyectos')
            <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-book"></i>
              <p>
                Mis proyectos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('inscripciones.mis_proyectos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de mis proyectos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan

           @can('admin.presupuestos.index')
              <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas bi bi-coin"></i>
              <p>
                Presupuestos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('admin/presupuestos/create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Creación de registro</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('admin/presupuestos')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listado de presupuestos</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
        

           @can('post.create')
           <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                 Crear Notificaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('post.create')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear notificación</p>
                </a>
              </li>
            </ul>
          </li>
        @endcan

           
          <li class="nav-item">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Ver notificaciones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('post.notifications')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notificaciones</p>
                </a>
              </li>
            </ul>
          </li>
         

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link" style="background-color: red"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon fas bi bi-door-closed"></i>
              <p>
                Cerrar Sesion 
              </p>
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @if( (($message = Session::get('mensaje')) && ($icono = Session::get('icono'))))
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "{{$icono}}",
                            title: "{{$message}}",
                            showConfirmButton: false,
                            timer: 4500
                        });
                    </script>
  @endif



<div class="content-wrapper">
    <br>
    <div class="container">
        @yield('content')
    </div>
</div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
     <div class="container">
        <div class="d-flex justify-content-center align-items-center py-1">
            <img src="{{ asset('dist/img/sirma-educacion-logo1.png') }}" class="mx-3" alt="Logo Educación" style="height: 50px;">
            <img src="{{ asset('dist/img/sirma-educacion-logo2.png') }}" class="mx-3"  alt="Logo Institución" style="height: 50px;">
            <img src="{{ asset('dist/img/sirma-educacion-logo3.png') }}" class="mx-3" alt="Logo Partner" style="height: 50px;">
        </div>
    </div>

      
  
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="{{url('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{url('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{url('dist/js/adminlte.min.js')}}"></script>
</body>
</html>
