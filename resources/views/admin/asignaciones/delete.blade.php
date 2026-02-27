<!-- Vista eliminar asignaciones -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Asignación: {{$asignacion->gestor->nombres}} {{$asignacion->gestor->apellidos}} - {{$asignacion->curso->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Está seguro de eliminar este registro?</h3>
                </div>
                 <div class="card-body">
         <form action="{{url('/admin/asignaciones', ['gestor' => $asignacion->gestor_id, 'curso' => $asignacion->curso_id])}}" method="POST">
                @csrf
                @method('DELETE')
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Gestor asignado</label> 
                           <p>{{$asignacion->gestor->nombres}} {{$asignacion->gestor->apellidos}}</p>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Curso asignado</label>
                           <p>{{$asignacion->curso->nombre}}</p>
                        </div>
                    </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/asignaciones')}}" class="btn btn-secondary">Cancelar</a>
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