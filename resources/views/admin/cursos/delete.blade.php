<!-- Vista eliminar curso -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Curso: {{$cursos->nombre}} </h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('/admin/cursos', $cursos->id)}}" method="POST">
                @csrf
                @method('DELETE')
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
                            <a href="{{url('admin/cursos')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">Eliminar curso</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection