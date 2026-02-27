@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registro Exitoso') }}</div>

                <div class="card-body">
                    <div class="alert alert-success">
                        {{ __('Se ha enviado un enlace de verificación a tu dirección de correo electrónico.') }}
                    </div>
                    <p>{{ __('Antes de continuar, por favor revisa tu correo y haz clic en el enlace de verificación.') }}</p>
                    <p>{{ __('Si no recibiste el correo') }}, <a href="{{ route('verification.resend') }}">{{ __('haz clic aquí para solicitar otro') }}</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection