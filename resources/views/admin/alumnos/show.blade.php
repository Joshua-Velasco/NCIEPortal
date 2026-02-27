<!-- Vista ver alumno -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Alumno: {{$alumno->nombres}} {{$alumno->apellidos}}</h1>
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
                            <p>{{$alumno->nombres}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Apellidos</label>
                            <p>{{$alumno->apellidos}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de nacimiento</label>
                            <p>{{$alumno->fecha_nacimiento}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Celular</label>
                            <p>{{$alumno->celular}}</p>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Correo electrónico</label>
                             <p>{{$alumno->correo}}</p>
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Numero de control</label>
                            <p>{{$alumno->numero_control}}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form group">
                            <label for="">Carrera</label>
                             <p>{{$alumno->carrera}}</p>
                        </div>
                        </div>
                          <div class="col-md-3">
                         <div class="form group">
                            <label for="">Semestre</label>
                            <p>{{$alumno->semestre}}</p>
                        </div>
                        </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/alumnos')}}" class="btn btn-secondary">Volver</a>
                         
                        </div>
                    </div>
                </div>
          
            </div>
            </div>
        </div>
    </div>
@endsection