<!-- Vista formulario crear asignacion gestor-curso -->
@extends('layouts.admin')

@section('content')
<div class="row">
        <h1>Registro de una nueva asignación</h1>
    </div>

    <hr>

 <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('/admin/asignaciones/create')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Gestor</label> <b>*</b>
                            <select class="form-control" id="gestor_id" name="gestor_id" required>
                        <option value="">Seleccione un gestor</option>
                        @foreach($gestores as $gestor)
                            <option value="{{ $gestor->id }}">{{ $gestor->nombres }} {{ $gestor->apellidos }}</option>
                        @endforeach
                    </select>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Curso</label> <b>*</b>
                        <select class="form-control" id="curso_id" name="curso_id" required>
                        <option value="">Seleccione un curso</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                        @endforeach
                    </select>
                        </div>
                    </div>
                </div>
              <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/asignaciones')}}" class="btn btn-secondary">Cancelar</a>
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