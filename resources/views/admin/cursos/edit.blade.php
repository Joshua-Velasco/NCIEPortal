<!-- Vista formulario editar curso -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar curso: {{$cursos->nombre}} </h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/cursos',$cursos->id)}}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row">
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Nombre del curso</label> <b>*</b>
                            <input type="text" value="{{$cursos->nombre}}" name="nombre" class="form-control" required>
                            @error('nombre')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de inicio</label> <b>*</b>
                             <input type="date" name="fecha_inicio" class="form-control" value="{{$cursos->fecha_inicio}}">
                            @error('fecha_inicio')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de fin</label> <b>*</b>
                            <input type="date" name="fecha_fin" class="form-control" value="{{$cursos->fecha_fin}}">
                            @error('fecha_fin')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Hora de inicio</label> <b>*</b>
                            <input type="time" name="hora_inicio" class="form-control" value="{{$cursos->hora_inicio}}">
                            @error('hora_inicio')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Hora fin</label> <b>*</b>
                            <input type="time" name="hora_fin" class="form-control" value="{{$cursos->hora_fin}}">
                            @error('hora_fin')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Lugar</label> <b>*</b>
                            <input type="text" value="{{$cursos->lugar}}" name="lugar" class="form-control" required>
                            @error('lugar')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Requisitos</label>
                            <input type="text" value="{{$cursos->requisitos}}" name="requisitos" class="form-control">
                            @error('requisitos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form group">
                            <label for="">Modalidad</label> <b>*</b>
                              <select name="modalidad" id="" class="form-control">
                                 <option value="presencial">Presencial</option>
                                 <option value="en_linea">En línea</option>
                              </select>
                        </div>
                        </div>
                          <div class="col-md-3">
                         <div class="form group">
                            <label for="">Descripcion</label>
                            <input type="text" value="{{$cursos->descripcion}}" name="descripcion" class="form-control">
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
                            <a href="{{url('admin/cursos')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar curso</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection