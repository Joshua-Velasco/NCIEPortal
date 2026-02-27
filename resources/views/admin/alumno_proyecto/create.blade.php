@extends('layouts.admin')

@section('content')
<div class="row">
        <h1>Registro de una nueva asignación Alumno-Proyecto</h1>
    </div>

    <hr>

 <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('/admin/alumno_proyecto/create')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Alumno</label> <b>*</b>
                            <select class="form-control" id="alumno_id" name="alumno_id" required>
                                <option value="">Seleccione un alumno</option>
                                @foreach($alumnos as $alumno)
                                    <option value="{{ $alumno->id }}">{{ $alumno->nombres }} {{ $alumno->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Proyecto</label> <b>*</b>
                            <select class="form-control" id="proyecto_id" name="proyecto_id" required>
                                <option value="">Seleccione un proyecto</option>
                                @foreach($proyectos as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Tipo de Proyecto</label> <b>*</b>
                            <select class="form-control" id="tipo" name="tipo" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="residencias">Residencias</option>
                                <option value="servicio_social">Servicio Social</option>
                                <option value="propio">Proyecto Propio</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha Fin</label>
                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                        </div>
                    </div>
                </div>
            
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{url('admin/alumno_proyecto')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar asignación</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
            </div>
        </div>
    </div>
@endsection