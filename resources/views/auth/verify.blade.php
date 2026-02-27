@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu dirección de correo electrónico') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.') }}
                    {{ __('Si no recibiste el correo') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}" id="resendForm">
    @csrf
    <button type="submit" class="btn btn-link p-0 m-0 align-baseline" id="resendButton">
        {{ __('haz clic aquí para solicitar otro') }}
    </button>.
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('resendForm').addEventListener('submit', function(e) {
        const button = document.getElementById('resendButton');
        button.disabled = true;
        button.textContent = '{{ __("Enviando...") }}';
        
        // Opcional: Prevenir múltiples envíos incluso si el usuario manipula el DOM
        e.target.removeEventListener('submit', arguments.callee);
    });
</script>
@endsection