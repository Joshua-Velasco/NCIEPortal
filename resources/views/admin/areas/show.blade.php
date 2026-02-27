<!-- Vista ver las áreas -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Área: {{$area->nombre}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header"> 
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                 <div class="card-body">
         
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
                            <a href="{{url('admin/areas')}}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
    
            </div>
            </div>
        </div>
    </div>
@endsection