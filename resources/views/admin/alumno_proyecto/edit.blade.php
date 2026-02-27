@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Alumno: {{ $asignacion->alumno->nombres ?? 'N/A' }} {{ $asignacion->alumno->apellidos ?? '' }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.alumno_proyecto.update', $asignacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alumno_id">Alumno</label> <b>*</b>
                                    <select name="alumno_id" class="form-control" required>
                                        <option value="{{ $asignacion->alumno_id }}" selected>
                                            {{ $asignacion->alumno->nombres }} {{ $asignacion->alumno->apellidos }}
                                        </option>
                                        @foreach($alumnos as $alumno)
                                            @if($alumno->id != $asignacion->alumno_id)
                                                <option value="{{ $alumno->id }}">
                                                    {{ $alumno->nombres }} {{ $alumno->apellidos }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('alumno_id')
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
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tipo">Tipo de Proyecto</label> <b>*</b>
                                    <select name="tipo" class="form-control" required>
                                        <option value="{{ $asignacion->tipo }}" selected>
                                            @if($asignacion->tipo == 'residencias')
                                                Residencias Profesionales
                                            @elseif($asignacion->tipo == 'servicio_social')
                                                Servicio Social
                                            @else
                                                Proyecto Propio
                                            @endif
                                        </option>
                                        <option value="residencias">Residencias Profesionales</option>
                                        <option value="servicio_social">Servicio Social</option>
                                        <option value="propio">Proyecto Propio</option>
                                    </select>
                                    @error('tipo')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha de Inicio</label>
                                    <input type="date" name="fecha_inicio" class="form-control" 
                                           value="{{ $asignacion->fecha_inicio}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha Fin</label>
                                    <input type="date" name="fecha_fin" class="form-control" 
                                           value="{{ $asignacion->fecha_fin}}">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('admin.alumno_proyecto.index') }}" class="btn btn-secondary">Cancelar</a>
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