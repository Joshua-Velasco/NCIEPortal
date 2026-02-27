<!-- Vista formulario editar asignaciones -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Actualización del gestor: {{ $asignacion->gestor->nombres ?? 'N/A' }} {{ $asignacion->gestor->apellidos ?? '' }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.asignaciones.update', ['gestor' => $asignacion->gestor_id, 'curso' => $asignacion->curso_id]) }}" method="POST">
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
                                    <label for="curso_id">Curso</label> <b>*</b>
                                    <select name="curso_id" class="form-control" required>
                                        <option value="{{ $asignacion->curso_id }}" selected>
                                            {{ $asignacion->curso->nombre }}
                                        </option>
                                        @foreach($cursos as $curso)
                                            @if($curso->id != $asignacion->curso_id)
                                                <option value="{{ $curso->id }}">
                                                    {{ $curso->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('curso_id')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
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