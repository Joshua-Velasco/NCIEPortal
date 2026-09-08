@extends('layouts.auth')
@section('title', 'Verifica tu correo')
@section('auth-theme', 'blue')
@section('auth-side', 'left')
@section('aside-title', 'Confirma tu correo')
@section('aside-text', 'Abre el enlace que te enviamos y entras directo al panel.')
@section('card-class', 'auth-card--wide')

@section('content')
  <ol class="steps" aria-label="Progreso">
    <li class="is-done"><span>1</span>Crear cuenta</li>
    <li class="is-current" aria-current="step"><span>2</span>Verificar correo</li>
    <li><span>3</span>Entrar al panel</li>
  </ol>

  <div class="auth-icon"><i class="bi bi-envelope-check"></i></div>
  <h1>Revisa tu correo</h1>
  <p class="lead">
    @auth
      Te enviamos un enlace de verificación a <strong>{{ auth()->user()->email }}</strong>. Ábrelo para activar tu cuenta.
    @else
      Te enviamos un enlace de verificación a tu correo. Ábrelo para activar tu cuenta.
    @endauth
  </p>

  @if (session('resent') || session('message') || session('status'))
    <div class="notice is-ok" role="status">Enviamos un nuevo enlace de verificación a tu correo.</div>
  @endif

  <div class="actions">
    <form method="POST" action="{{ route('verification.resend') }}" id="resendForm">
      @csrf
      <button type="submit" class="btn btn-auth" id="resendButton">Reenviar enlace</button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn btn-glass">Cerrar sesión</button>
    </form>
  </div>

@endsection

@section('scripts')
<script>
  document.getElementById('resendForm').addEventListener('submit', function () {
    var b = document.getElementById('resendButton');
    b.disabled = true;
    b.textContent = 'Enviando…';
  });
</script>
@endsection
