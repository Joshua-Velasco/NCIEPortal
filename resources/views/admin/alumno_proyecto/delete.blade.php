@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Alumno: {{$asignacion->alumno->nombres}} {{$asignacion->alumno->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-8">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/alumno_proyecto', $asignacion->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Alumno</label> 
                                    <p>{{$asignacion->alumno->nombres}} {{$asignacion->alumno->apellidos}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Proyecto asignado</label>
                                    <p>{{$asignacion->proyecto->nombre}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Tipo de proyecto</label>
                                    <p>
                                        @if($asignacion->tipo == 'residencias')
                                            Residencias Profesionales
                                        @elseif($asignacion->tipo == 'servicio_social')
                                            Servicio Social
                                        @else
                                            Proyecto Propio
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de inicio</label>
                                    <p>{{ $asignacion->fecha_inicio ? \Carbon\Carbon::parse($asignacion->fecha_inicio)->format('d/m/Y') : 'No especificada' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Fecha de fin</label>
                                    <p>{{ $asignacion->fecha_fin ? \Carbon\Carbon::parse($asignacion->fecha_fin)->format('d/m/Y') : 'No especificada' }}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{url('admin/alumno_proyecto')}}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-danger">Eliminar asignación</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection