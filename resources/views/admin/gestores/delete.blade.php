<!-- Vista eliminar gestor -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Gestor: {{$gestor->nombres." ".$gestor->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/gestores', $gestor->id)}}" method="POST">
                @csrf
                @method('DELETE')
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
                            <a href="{{url('admin/gestores')}}" class="btn btn-secondary">Cancelar</a>
                             <button type="submit" class="btn btn-danger">Eliminar gestor</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection