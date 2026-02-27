<!-- Vista ver curso -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Curso: {{$cursos->nombre}}</h1>
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
                            <label for="">Nombre del curso</label>
                            <p>{{$cursos->nombre}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de inicio</label>
                            <p>{{$cursos->fecha_inicio}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de fin</label>
                            <p>{{$cursos->fecha_fin}}</p>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Hora de inicio</label>
                            <p>{{$cursos->hora_inicio}}</p>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Hora fin</label>
                            <p>{{$cursos->hora_fin}}</p>
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Lugar</label>
                            <p>{{$cursos->lugar}}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Requisitos</label>
                             <p>{{$cursos->requisitos}}</p>
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Modalidad</label>
                            <p>{{$cursos->modalidad}}</p>
                        </div>
                    </div>
                          <div class="col-md-3">
                         <div class="form group">
                            <label for="">Descripcion</label>
                            <p>{{$cursos->descripcion}}</p>
                        </div>
                        </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/cursos')}}" class="btn btn-secondary">Volver</a>
                         
                        </div>
                    </div>
                </div>
          
            </div>
            </div>
        </div>
    </div>
@endsection