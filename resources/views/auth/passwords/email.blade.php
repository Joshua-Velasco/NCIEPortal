@extends('layouts.auth')
@section('title', 'Recuperar contraseña')
@section('aside-title', 'Recupera el acceso')
@section('aside-text', 'Escribe tu correo y te enviamos un enlace para elegir una contraseña nueva.')
@section('back-url', route('login'))
@section('back-label', 'Volver a iniciar sesión')

@section('content')
  <h1>Recupera tu contraseña</h1>
  <p class="lead">Escribe el correo con el que te registraste. Te enviaremos un enlace para elegir una contraseña nueva.</p>

  @if (session('status'))
    <div class="notice is-ok" role="status">{{ session('status') }}</div>
  @endif

  <form method="POST" action="{{ route('password.email') }}" novalidate>
    @csrf
    <div class="field">
      <label for="email">Correo electrónico</label>
      <input id="email" class="input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      @error('email')<p class="hint" role="alert">{{ $message }}</p>@enderror
    </div>
    <button type="submit" class="btn btn-auth btn-block">Enviar enlace</button>
  </form>

  <div class="auth-alt">
    <p>¿La recordaste? <a href="{{ route('login') }}">Inicia sesión</a>.</p>
  </div>
@endsection
