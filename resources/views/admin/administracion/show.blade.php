<!-- Vista ver usuario -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Administrativo: {{$administrativo->nombres}} {{$administrativo->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header"> 
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                 <div class="card-body">
              
                 <div class="row">
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">nombre del administrativo:</label> 
                            <p>{{$administrativo->nombres}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Apellido del administrativo:</label> 
                            <p>{{$administrativo->apellidos}}</p>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Teléfono:</label>
                            <p>{{$administrativo->telefono}}</p>
                        </div>
                    </div>
                </div>
                <br>
                   <div class="row">
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">Carrera:</label> 
                            <p>{{$administrativo->carrera}}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Grado Académico:</label> 
                            <p>{{$administrativo->grado_academico}}</p>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Correo electrónico:</label>
                            <p>{{$administrativo->user->email}}</p>
                        </div>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/administracion')}}" class="btn btn-secondary">Cancelar</a>
                          
                        </div>
                    </div>
                </div>
          
            </div>
            </div>
        </div>
    </div>
@endsection