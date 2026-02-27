<!-- Vista formulario crear asignacion gestor-proyecto -->
@extends('layouts.admin')

@section('content')
<div class="row">
        <h1>Registro de una nueva asignación Gestor-Proyecto</h1>
    </div>

    <hr>

 <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('/admin/proyecto_gestores/create')}}" method="POST">
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
              <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/proyecto_gestores')}}" class="btn btn-secondary">Cancelar</a>
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