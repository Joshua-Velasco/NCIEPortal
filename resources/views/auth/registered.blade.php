@extends('layouts.auth')
@section('title', 'Cuenta creada')
@section('auth-theme', 'red')
@section('auth-side', 'right')
@section('auth-image', 'nodo2.jpg')
@section('aside-title', 'Ya casi estás dentro')
@section('aside-text', 'Solo falta abrir el enlace que te enviamos al correo.')
@section('card-class', 'auth-card--wide')

@section('content')
  <ol class="steps" aria-label="Progreso">
    <li class="is-done"><span>1</span>Crear cuenta</li>
    <li class="is-current" aria-current="step"><span>2</span>Verificar correo</li>
    <li><span>3</span>Entrar al panel</li>
  </ol>

  <div class="auth-icon"><i class="bi bi-patch-check"></i></div>
  <h1>Tu cuenta está lista</h1>
  <p class="lead">
    @auth
      Solo falta verificar tu correo. Te enviamos un enlace a <strong>{{ auth()->user()->email }}</strong>; ábrelo para activar la cuenta.
    @else
      Solo falta verificar tu correo. Te enviamos un enlace a tu bandeja; ábrelo para activar la cuenta.
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
    <a href="{{ url('/') }}" class="btn btn-glass">Ir al inicio</a>
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
