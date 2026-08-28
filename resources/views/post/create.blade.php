@extends('layouts.admin')

@section('content')

<div class="row">
    <h1>Crear aviso</h1>
</div>
<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">El aviso aparece en el panel de cada persona. No se envía por correo.</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('post.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="for_users_only">Destinatarios</label> <b>*</b>
                                <select id="for_users_only" name="for_users_only" class="form-control" required>
                                    <option value="0" @selected(old('for_users_only', '0') === '0')>Comunidad del nodo: administrativos, gestores y alumnos</option>
                                    <option value="1" @selected(old('for_users_only') === '1')>Solo usuarios externos registrados</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="title">Título</label> <b>*</b>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" placeholder="Por ejemplo: Nuevo taller de impresión 3D" maxlength="255" required>
                                @error('title')<span class="invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Mensaje</label> <b>*</b>
                        <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Escribe el aviso completo. Puedes incluir fechas, lugar y a quién contactar." required>{{ old('description') }}</textarea>
                        @error('description')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <hr>
                    <a href="{{ route('post.notifications') }}" class="btn btn-secondary">Ver notificaciones</a>
                    <button class="btn btn-primary" type="submit">Publicar aviso</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
