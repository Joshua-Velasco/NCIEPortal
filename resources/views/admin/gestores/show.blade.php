<!-- Vista ver gestor -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Gestor: {{$gestor->nombres." ".$gestor->apellidos}}</h1>
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
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Nombres</label>
                            <p>{{$gestor->nombres}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Apellidos</label>
                            <p>{{$gestor->apellidos}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de nacimiento</label>
                            <p>{{$gestor->fecha_nacimiento}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Celular</label>
                            <p>{{$gestor->celular}}</p>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Carrera</label>
                            <p>{{$gestor->carrera}}</p>
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Grado ácademico</label>
                            <p>{{$gestor->grado_academico}}</p>
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Correo electrónico</label>
                            <p>{{$gestor->user->email}}</p>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/gestores')}}" class="btn btn-secondary">Volver</a>
                        </div>
                    </div>
                </div>
  
            </div>
            </div>
        </div>
    </div>
@endsection