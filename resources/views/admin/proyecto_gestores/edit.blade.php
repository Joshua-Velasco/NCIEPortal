@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Gestor: {{ $asignacion->gestor->nombres ?? 'N/A' }} {{ $asignacion->gestor->apellidos ?? '' }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.proyecto_gestores.update', $asignacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gestor_id">Gestor</label> <b>*</b>
                                    <select name="gestor_id" class="form-control" required>
                                        <option value="{{ $asignacion->gestor_id }}" selected>
                                            {{ $asignacion->gestor->nombres }} {{ $asignacion->gestor->apellidos }}
                                        </option>
                                        @foreach($gestores as $gestor)
                                            @if($gestor->id != $asignacion->gestor_id)
                                                <option value="{{ $gestor->id }}">
                                                    {{ $gestor->nombres }} {{ $gestor->apellidos }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('gestor_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="proyecto_id">Proyecto</label> <b>*</b>
                                    <select name="proyecto_id" class="form-control" required>
                                        <option value="{{ $asignacion->proyecto_id }}" selected>
                                            {{ $asignacion->proyecto->nombre }}
                                        </option>
                                        @foreach($proyectos as $proyecto)
                                            @if($proyecto->id != $asignacion->proyecto_id)
                                                <option value="{{ $proyecto->id }}">
                                                    {{ $proyecto->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('proyecto_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.proyecto_gestores.index') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar asignación</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection