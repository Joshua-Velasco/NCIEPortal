<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
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

  <!-- Tema NCIE -->
  <link rel="stylesheet" href="{{ url('dist/css/ncie-admin.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/admin')}}" class="nav-link ncie-navbar-brand"><i class="bi bi-grid-1x2-fill"></i> Panel NCIE</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
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
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
         <div class="image">
          <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0B1230&color=fff" class="img-circle elevation-2" alt="Avatar">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link nav-link-logout" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              <i class="nav-icon bi bi-door-closed"></i>
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



<!-- AdminLTE App -->
<script src="{{url('dist/js/adminlte.min.js')}}"></script>
</body>

</html>
