@extends('layouts.auth')
@section('title', 'Nueva contraseña')
@section('aside-title', 'Casi de vuelta')
@section('aside-text', 'Elige una contraseña nueva y segura para tu cuenta del nodo.')
@section('back-url', route('login'))
@section('back-label', 'Volver a iniciar sesión')

@section('content')
  <h1>Elige una contraseña nueva</h1>
  <p class="lead">Confirma tu correo y escribe la contraseña que usarás a partir de ahora.</p>

  @if (session('status'))
    <div class="notice is-ok" role="status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.update') }}" novalidate>
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="field">
      <label for="email">Correo electrónico</label>
      <input id="email" class="input @error('email') is-invalid @enderror" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
      @error('email')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>

    <div class="field">
      <label for="password">Contraseña nueva</label>
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

    <button type="submit" class="btn btn-auth btn-block">Guardar contraseña</button>
  </form>

  <div class="auth-alt">
    <p>¿Necesitas ayuda? Escríbenos a <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a>.</p>
  </div>
@endsection
