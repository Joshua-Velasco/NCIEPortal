<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Acceso') · NCIE</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wdth,wght@0,62..125,100..900;1,62..125,100..900&display=swap" rel="stylesheet">

  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/ncie.css') }}" rel="stylesheet">
</head>
<body class="auth-body auth-theme-@yield('auth-theme', 'blue') auth-side-@yield('auth-side', 'left')">
  @php $authImage = trim($__env->yieldContent('auth-image', 'nodo.png')); @endphp
  <aside class="auth-visual">
    <img src="{{ asset('assets/img/' . $authImage) }}" alt="">
    <a href="{{ url('/') }}" class="brand">
      <img src="{{ asset('assets/img/logo.png') }}" alt="" width="40" height="40">
      <span>NCIE<small>Instituto Tecnológico de Ciudad Juárez</small></span>
    </a>
    <div class="auth-visual-text">
      <h2>@yield('aside-title', 'Bienvenido al nodo')</h2>
      <p>@yield('aside-text', 'Cursos, talleres y proyectos reales del Nodo de Creatividad, Innovación y Emprendimiento del ITCJ.')</p>
      @hasSection('aside-list')
        <ul>@yield('aside-list')</ul>
      @endif
    </div>
  </aside>

  <main class="auth-panel">
    <a class="back" href="@yield('back-url', url('/'))"><i class="bi bi-arrow-left"></i> @yield('back-label', 'Volver al inicio')</a>
    <div class="auth-card @yield('card-class')">
      @yield('content')
      <p class="auth-foot">© {{ date('Y') }} NCIE, Instituto Tecnológico de Ciudad Juárez</p>
    </div>
  </main>

  <script>
    document.querySelectorAll('.pw-toggle[data-target]').forEach(function (btn) {
      var input = document.getElementById(btn.getAttribute('data-target'));
      if (!input) return;
      btn.addEventListener('click', function () {
        var show = input.type === 'password';
        input.type = show ? 'text' : 'password';
        btn.firstElementChild.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
        btn.setAttribute('aria-label', show ? 'Ocultar contraseña' : 'Mostrar contraseña');
      });
    });
  </script>
  @yield('scripts')
</body>
</html>
