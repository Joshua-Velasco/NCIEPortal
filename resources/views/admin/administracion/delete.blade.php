<!-- Vista formulario eliminar administrativo -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Eliminar administrativo: {{$administrativo->nombres}} {{$administrativo->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header"> 
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/administracion', $administrativo->id)}}" method="POST">
                @csrf
                @method('DELETE')
                 <div class="row">
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Nombres</label>
                            <input type="text" value="{{$administrativo->nombres}}" name="nombres" class="form-control" disabled>
                            @error('nombres')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Apellidos</label>
                            <input type="text" value="{{$administrativo->apellidos}}" name="apellidos" class="form-control" disabled>
                            @error('apellidos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Teléfono</label> 
                            <input type="text" value="{{$administrativo->telefono}}" name="telefono" class="form-control" disabled>
                            @error('telefono')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">Carrera</label>
                            <input type="text" value="{{$administrativo->carrera}}" name="carrera" class="form-control" disabled>
                            @error('carrera')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">Grado Académico</label> 
                            <input type="text" value="{{$administrativo->grado_academico}}" name="grado_academico" class="form-control" disabled>
                            @error('grado_academico')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Correo electrónico</label>
                            <input type="email" value="{{$administrativo->user->email}}" name="email" class="form-control" disabled>
                            @error('email')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/administracion')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-danger">Eliminar administrativo</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection