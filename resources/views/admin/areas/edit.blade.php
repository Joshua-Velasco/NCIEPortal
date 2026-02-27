<!-- Vista formulario editar áreas -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Actualización del área: {{$area->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('admin/areas', $area->id)}}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Nombre del área</label> <b>*</b>
                            <input type="text" value="{{$area->nombre}}" name="nombre" class="form-control" required>
                            @error('nombre')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Descripción</label> <b>*</b>
                            <input type="text" value="{{$area->descripcion}}" name="descripcion" class="form-control" required>
                            @error('descripcion')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/areas')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar área</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection