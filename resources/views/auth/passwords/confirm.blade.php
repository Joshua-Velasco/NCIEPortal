@extends('layouts.auth')
@section('title', 'Confirmar contraseña')
@section('aside-title', 'Un paso de seguridad')
@section('aside-text', 'Confirma tu contraseña antes de continuar con esta acción.')

@section('content')
  <h1>Confirma tu contraseña</h1>
  <p class="lead">Para proteger tu cuenta, escribe tu contraseña antes de continuar.</p>

  <form method="POST" action="{{ route('password.confirm') }}" novalidate>
    @csrf
    <div class="field">
      <label for="password">Contraseña</label>
      <div class="pw">
        <input id="password" class="input @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" autofocus>
        <button type="button" class="pw-toggle" data-target="password" aria-label="Mostrar contraseña"><i class="bi bi-eye"></i></button>
      </div>
      @error('password')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>
    <button type="submit" class="btn btn-auth btn-block">Confirmar</button>
  </form>

  @if (Route::has('password.request'))
    <div class="auth-alt">
      <p><a href="{{ route('password.request') }}">Olvidé mi contraseña</a></p>
    </div>
  @endif
@endsection
