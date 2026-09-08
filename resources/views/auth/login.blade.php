@extends('layouts.auth')
@section('title', 'Iniciar sesión')
@section('aside-title', 'Bienvenido de vuelta')
@section('aside-text', 'Entra para ver el calendario de cursos, inscribirte y seguir tus actividades en el nodo.')
@section('aside-list')
  <li>Cursos y talleres gratuitos</li>
  <li>Proyectos reales con empresas</li>
  <li>Avisos del nodo en tu cuenta</li>
@endsection

@section('content')
  <h1>Inicia sesión</h1>
  <p class="lead">Usa el correo y la contraseña con que te registraste.</p>

  @if (session('status'))
    <div class="notice is-ok" role="status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('login') }}" novalidate>
    @csrf
    <div class="field">
      <label for="email">Correo electrónico</label>
      <input id="email" class="input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      @error('email')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="field">
      <label for="password">Contraseña</label>
      <div class="pw">
        <input id="password" class="input @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password">
        <button type="button" class="pw-toggle" data-target="password" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
      </div>
      @error('password')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="row-between">
      <label class="check"><input type="checkbox" name="remember" @checked(old('remember'))> Mantener la sesión abierta</label>
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
      @endif
    </div>

    <button type="submit" class="btn btn-auth btn-block">Entrar</button>
  </form>

  <div class="auth-alt">
    <p>¿Aún no tienes cuenta? <a href="{{ route('register') }}">Crea una</a> para inscribirte a los cursos.</p>
  </div>
@endsection
