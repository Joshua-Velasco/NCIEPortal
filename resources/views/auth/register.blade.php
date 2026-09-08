@extends('layouts.auth')
@section('title', 'Crear cuenta')
@section('auth-theme', 'red')
@section('auth-side', 'right')
@section('auth-image', 'nodo2.jpg')
@section('card-class', 'auth-card--wide')
@section('aside-title', 'Únete al nodo')
@section('aside-text', 'Crea tu cuenta gratis para inscribirte a cursos y talleres, y dar seguimiento a tus actividades.')
@section('aside-list')
  <li>Abierto a estudiantes y comunidad</li>
  <li>Inscripción con un clic desde tu panel</li>
  @if (config('ncie.email_verification'))<li>Solo necesitas verificar tu correo</li>@else<li>Entras al panel en cuanto la creas</li>@endif
@endsection

@section('content')
  <h1>Crea tu cuenta</h1>
  <p class="lead">Te tomará menos de un minuto.</p>

  <form method="POST" action="{{ route('register') }}" novalidate>
    @csrf
    <div class="field">
      <label for="name">Nombre y apellidos</label>
      <input id="name" class="input @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      @error('name')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="field">
      <label for="email">Correo electrónico</label>
      <input id="email" class="input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
      @error('email')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="field-row">
    <div class="field">
      <label for="password">Contraseña</label>
      <div class="pw">
        <input id="password" class="input @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
        <button type="button" class="pw-toggle" data-target="password" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
      </div>
      @error('password')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="field">
      <label for="password-confirm">Repite la contraseña</label>
      <div class="pw">
        <input id="password-confirm" class="input" type="password" name="password_confirmation" required autocomplete="new-password">
        <button type="button" class="pw-toggle" data-target="password-confirm" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
      </div>
    </div>
    </div>

    <div class="field">
      <label class="check">
        <input type="checkbox" id="terms" name="terms" required @checked(old('terms'))>
        <span>Acepto los <a href="#terms-dialog" id="open-terms">términos y condiciones</a> del NCIE.</span>
      </label>
      @error('terms')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <button type="submit" class="btn btn-auth btn-block">Crear cuenta</button>
  </form>

  <div class="auth-alt">
    <p>¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>.</p>
  </div>

  <dialog class="terms" id="terms-dialog" aria-labelledby="terms-title">
    <div class="terms-head">
      <h2 id="terms-title">Términos y condiciones</h2>
      <button type="button" class="pw-toggle" data-close aria-label="Cerrar"><i class="bi bi-x-lg"></i></button>
    </div>
    <div class="terms-body">
      <h3>1. Aceptación de los términos</h3>
      <p>Al acceder y utilizar este sitio web, propiedad del Nodo de Creatividad, Innovación Tecnológica y Emprendimiento (NCIE) del Instituto Tecnológico de Ciudad Juárez (ITCJ), aceptas estos términos y condiciones en su totalidad. Si no estás de acuerdo con alguna parte, no uses el sitio.</p>

      <h3>2. Uso del servicio</h3>
      <p>El NCIE es una plataforma universitaria que ofrece:</p>
      <ul>
        <li>Cursos de formación abiertos a estudiantes y público en general.</li>
        <li>Registro de usuarios con acceso limitado según su rol: inscripción a cursos y consulta de sus actividades.</li>
      </ul>

      <h3>3. Registro de usuarios</h3>
      <ul>
        <li>Solo los usuarios registrados pueden inscribirse a los cursos disponibles.</li>
        <li>Los datos proporcionados deben ser verídicos y estar actualizados.</li>
        <li>La cuenta es personal e intransferible; eres responsable de su uso.</li>
      </ul>

      <h3>4. Uso adecuado de la plataforma</h3>
      <p>Te comprometes a:</p>
      <ul>
        <li>No utilizar el sitio con fines ilegales o fraudulentos.</li>
        <li>No compartir tus credenciales de acceso.</li>
        <li>No alterar, copiar o distribuir contenido sin autorización.</li>
      </ul>

      <h3>5. Privacidad y protección de datos</h3>
      <p>El tratamiento de datos personales se rige por la Ley Federal de Protección de Datos Personales. Al registrarte autorizas el uso de tu información para la gestión de cursos y la mejora de los servicios. Puedes ejercer tus derechos ARCO (acceso, rectificación, cancelación y oposición) escribiendo a ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx.</p>

      <h3>6. Propiedad intelectual</h3>
      <p>Todo el contenido (imágenes y logotipos) es propiedad del Tecnológico Nacional de México (TecNM) y del Instituto Tecnológico de Ciudad Juárez (ITCJ), campus 1. Queda prohibida su reproducción sin autorización.</p>

      <h3>7. Limitación de responsabilidad</h3>
      <ul>
        <li>El NCIE no garantiza la disponibilidad permanente del sitio.</li>
        <li>No se responsabiliza por daños derivados del uso incorrecto de la plataforma.</li>
        <li>Los cursos pueden cambiar de fecha o cancelarse por causas ajenas al NCIE.</li>
      </ul>

      <h3>8. Modificaciones</h3>
      <p>Estos términos pueden actualizarse. Se notificará a los usuarios por correo o mediante anuncios en el sitio.</p>

      <h3>Contacto</h3>
      <p>Para dudas sobre estos términos escribe a ncie@itcj.edu.mx o ncie@cdjuarez.tecnm.mx.</p>
    </div>
    <div class="terms-foot">
      <button type="button" class="btn btn-blue" data-close>Entendido</button>
    </div>
  </dialog>
@endsection

@section('scripts')
<script>
  (function () {
    var dlg = document.getElementById('terms-dialog');
    var open = document.getElementById('open-terms');
    if (!dlg || !open) return;
    open.addEventListener('click', function (e) {
      e.preventDefault();
      if (typeof dlg.showModal === 'function') { dlg.showModal(); } else { dlg.setAttribute('open', ''); }
    });
    dlg.querySelectorAll('[data-close]').forEach(function (b) {
      b.addEventListener('click', function () { dlg.close ? dlg.close() : dlg.removeAttribute('open'); });
    });
  })();
</script>
@endsection
