<!-- Vista eliminar las áreas -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Área: {{$area->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                 <div class="card-body">
         <form action="{{url('/admin/areas', $area->id)}}" method="POST">
                @csrf
                @method('DELETE')
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Nombre del área</label> 
                           <p>{{$area->nombre}}</p>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Descripción</label>
                           <p>{{$area->descripcion}}</p>
                        </div>
                    </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/areas')}}" class="btn btn-secondary">Cancelar</a>
                             <button type="submit" class="btn btn-danger">Eliminar área</button>
                        </div>
                    </div>
                </div>
         </form>
            </div>
            </div>
        </div>
    </div>
@endsection