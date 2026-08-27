<!-- Plantilla del panel — Sistema NCIE -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sistema NCIE</title>

  <link href="{{url('dist/img/logo.png')}}" rel="icon">

  <!-- Google Fonts: Archivo -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:ital,wdth,wght@0,62..125,100..900;1,62..125,100..900&display=swap">
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

  <!-- Tema NCIE (siempre al final para sobreescribir) -->
  <link rel="stylesheet" href="{{ url('dist/css/ncie-admin.css') }}">

  <!-- fullcalendar -->
   <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>
   <script src="{{url('fullcalendar/es.global.js')}}"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
@php
  $ncieRol = Auth::user()->roles->pluck('name')->first() ?? 'Usuario';
@endphp
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" data-enable-remember="true" href="#" role="button" aria-label="Menú"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin')}}" class="nav-link ncie-navbar-brand"><i class="bi bi-grid-1x2-fill"></i> Panel NCIE</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-label="Notificaciones">
          <i class="far fa-bell"></i>
            @if (count(auth()->user()->unreadNotifications))
            <span class="badge ncie-nav-badge">{{count(auth()->user()->unreadNotifications)}}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right ncie-notif-menu">
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

      <!-- Usuario -->
      <li class="nav-item dropdown">
        <a class="nav-link ncie-user-toggle" data-toggle="dropdown" href="#" role="button" aria-label="Cuenta">
          <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0B1230&color=fff" class="ncie-avatar" alt="Avatar">
          <span class="ncie-user-meta d-none d-md-flex">
            <span class="ncie-user-name">{{ Auth::user()->name }}</span>
            <span class="ncie-user-role">{{ Str::ucfirst($ncieRol) }}</span>
          </span>
          <i class="bi bi-chevron-down ncie-user-caret d-none d-md-inline"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right ncie-user-menu">
          <div class="ncie-user-menu-head">
            <strong>{{ Auth::user()->name }}</strong>
            <small>{{ Auth::user()->email }}</small>
          </div>
          <div class="dropdown-divider"></div>
          <a href="{{ route('post.notifications') }}" class="dropdown-item"><i class="bi bi-bell mr-2"></i> Notificaciones</a>
          <a href="{{ url('/') }}" class="dropdown-item"><i class="bi bi-globe2 mr-2"></i> Ir al sitio público</a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item text-danger"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right mr-2"></i> Cerrar sesión
          </a>
        </div>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('')}}" class="brand-link">
      <img src="{{url('dist/img/logo.png')}}" alt="Logo NCIE" class="brand-image">
      <span class="brand-text ncie-brand-text">
        <strong>NCIE</strong>
        <small>Sistema de gestión</small>
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Menú: enlaces directos agrupados; cada listado tiene su botón de crear -->
      <nav class="ncie-menu">
        <ul class="nav nav-pills nav-sidebar flex-column" role="menu">

          <li class="nav-item">
            <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
              <i class="nav-icon bi bi-house-door-fill"></i><p>Inicio</p>
            </a>
          </li>

          @canany(['admin.usuarios.index', 'admin.administracion.index', 'admin.alumnos.index', 'admin.gestores.index'])
          <li class="nav-header">Personas</li>
          @endcanany
          @can('admin.usuarios.index')
          <li class="nav-item"><a href="{{ url('admin/usuarios') }}" class="nav-link {{ request()->is('admin/usuarios*') ? 'active' : '' }}"><i class="nav-icon bi bi-people-fill"></i><p>Usuarios</p></a></li>
          @endcan
          @can('admin.administracion.index')
          <li class="nav-item"><a href="{{ url('admin/administracion') }}" class="nav-link {{ request()->is('admin/administracion*') ? 'active' : '' }}"><i class="nav-icon bi bi-person-circle"></i><p>Administrativos</p></a></li>
          @endcan
          @can('admin.alumnos.index')
          <li class="nav-item"><a href="{{ url('admin/alumnos') }}" class="nav-link {{ request()->is('admin/alumnos*') ? 'active' : '' }}"><i class="nav-icon bi bi-person-add"></i><p>Alumnos</p></a></li>
          @endcan
          @can('admin.gestores.index')
          <li class="nav-item"><a href="{{ url('admin/gestores') }}" class="nav-link {{ request()->is('admin/gestores*') ? 'active' : '' }}"><i class="nav-icon bi bi-person-lines-fill"></i><p>Gestores</p></a></li>
          @endcan

          @canany(['admin.areas.index', 'admin.horarios.index', 'admin.cursos.index', 'admin.asignaciones.index'])
          <li class="nav-header">Académico</li>
          @endcanany
          @can('admin.areas.index')
          <li class="nav-item"><a href="{{ url('admin/areas') }}" class="nav-link {{ request()->is('admin/areas*') ? 'active' : '' }}"><i class="nav-icon bi bi-building-add"></i><p>Áreas</p></a></li>
          @endcan
          @can('admin.horarios.index')
          <li class="nav-item"><a href="{{ url('admin/horarios') }}" class="nav-link {{ request()->is('admin/horarios*') ? 'active' : '' }}"><i class="nav-icon bi bi-calendar2-week"></i><p>Horarios</p></a></li>
          @endcan
          @can('admin.cursos.index')
          <li class="nav-item"><a href="{{ url('admin/cursos') }}" class="nav-link {{ request()->is('admin/cursos*') ? 'active' : '' }}"><i class="nav-icon bi bi-clipboard2-check"></i><p>Cursos</p></a></li>
          @endcan
          @can('admin.asignaciones.index')
          <li class="nav-item"><a href="{{ url('admin/asignaciones') }}" class="nav-link {{ request()->is('admin/asignaciones*') ? 'active' : '' }}"><i class="nav-icon bi bi-clipboard2-minus-fill"></i><p>Asignación de cursos</p></a></li>
          @endcan

          @canany(['admin.proyectos.index', 'admin.proyecto_gestores.index', 'admin.alumno_proyecto.index', 'admin.presupuestos.index'])
          <li class="nav-header">Proyectos</li>
          @endcanany
          @can('admin.proyectos.index')
          <li class="nav-item"><a href="{{ url('admin/proyectos') }}" class="nav-link {{ request()->is('admin/proyectos*') ? 'active' : '' }}"><i class="nav-icon bi bi-book"></i><p>Proyectos</p></a></li>
          @endcan
          @can('admin.proyecto_gestores.index')
          <li class="nav-item"><a href="{{ url('admin/proyecto_gestores') }}" class="nav-link {{ request()->is('admin/proyecto_gestores*') ? 'active' : '' }}"><i class="nav-icon bi bi-journal-check"></i><p>Proyectos a gestores</p></a></li>
          @endcan
          @can('admin.alumno_proyecto.index')
          <li class="nav-item"><a href="{{ url('admin/alumno_proyecto') }}" class="nav-link {{ request()->is('admin/alumno_proyecto*') ? 'active' : '' }}"><i class="nav-icon bi bi-journal-plus"></i><p>Proyectos a alumnos</p></a></li>
          @endcan
          @can('admin.presupuestos.index')
          <li class="nav-item"><a href="{{ url('admin/presupuestos') }}" class="nav-link {{ request()->is('admin/presupuestos*') ? 'active' : '' }}"><i class="nav-icon bi bi-coin"></i><p>Presupuestos</p></a></li>
          @endcan

          @canany(['inscripciones.mis-cursos', 'reportes.index', 'reportes.mis_proyectos', 'inscripciones.mis_proyectos'])
          <li class="nav-header">Mi espacio</li>
          @endcanany
          @can('inscripciones.mis-cursos')
          <li class="nav-item"><a href="{{ route('inscripciones.mis-cursos') }}" class="nav-link {{ request()->routeIs('inscripciones.mis-cursos') ? 'active' : '' }}"><i class="nav-icon bi bi-clipboard2-check"></i><p>Mis cursos</p></a></li>
          @endcan
          @can('reportes.index')
          <li class="nav-item"><a href="{{ route('reportes.cursos-asignados') }}" class="nav-link {{ request()->routeIs('reportes.cursos-asignados') ? 'active' : '' }}"><i class="nav-icon bi bi-clipboard2-check"></i><p>Mis cursos</p></a></li>
          <li class="nav-item"><a href="{{ route('reportes.index') }}" class="nav-link {{ request()->routeIs('reportes.index') ? 'active' : '' }}"><i class="nav-icon bi bi-people"></i><p>Inscritos a mis cursos</p></a></li>
          @endcan
          @can('reportes.mis_proyectos')
          <li class="nav-item"><a href="{{ route('reportes.mis_proyectos') }}" class="nav-link {{ request()->routeIs('reportes.mis_proyectos') ? 'active' : '' }}"><i class="nav-icon bi bi-book"></i><p>Mis proyectos</p></a></li>
          @endcan
          @can('inscripciones.mis_proyectos')
          <li class="nav-item"><a href="{{ route('inscripciones.mis_proyectos') }}" class="nav-link {{ request()->routeIs('inscripciones.mis_proyectos') ? 'active' : '' }}"><i class="nav-icon bi bi-book"></i><p>Mis proyectos</p></a></li>
          @endcan

          <li class="nav-header">Comunicación</li>
          @can('post.create')
          <li class="nav-item"><a href="{{ route('post.create') }}" class="nav-link {{ request()->routeIs('post.create') ? 'active' : '' }}"><i class="nav-icon bi bi-megaphone-fill"></i><p>Crear aviso</p></a></li>
          @endcan
          <li class="nav-item"><a href="{{ route('post.notifications') }}" class="nav-link {{ request()->routeIs('post.notifications') ? 'active' : '' }}"><i class="nav-icon bi bi-bell-fill"></i><p>Notificaciones</p></a></li>
        </ul>

        <ul class="nav nav-pills nav-sidebar flex-column ncie-menu-bottom" role="menu">
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link nav-link-logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="nav-icon bi bi-box-arrow-right"></i><p>Cerrar sesión</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
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

  <!-- Contenido -->
  <div class="content-wrapper">
    <section class="content pt-4 pb-5">
      <div class="container-fluid px-4">
        @yield('content')
      </div>
    </section>
  </div>

  <!-- Main Footer -->
  <footer class="main-footer">
    <div class="ncie-footer">
      <p class="ncie-footer-copy">&copy; {{ date('Y') }} <strong>NCIE</strong> &middot; Instituto Tecnológico de Ciudad Juárez</p>
      <div class="ncie-footer-logos">
        <img src="{{ asset('dist/img/sirma-educacion-logo1.png') }}" alt="Logo Educación">
        <img src="{{ asset('dist/img/sirma-educacion-logo2.png') }}" alt="Logo Institución">
        <img src="{{ asset('dist/img/sirma-educacion-logo3.png') }}" alt="Logo Partner">
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
