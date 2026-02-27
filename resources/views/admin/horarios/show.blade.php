<!-- Vista ver horario -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Datos del horario</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header"> 
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                 <div class="card-body">
              
                <div class="row">
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Gestor</label> 
                              <p>{{$horario->gestor->nombres." ".$horario->gestor->apellidos}}</p>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Área</label>
                           <p>{{$horario->area->nombre}}</p>
                        </div>
                    </div>
                 </div>
                    <br>
                 <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Días</label>
                            <p>{{$horario->dia}}</p>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Hora inicio</label> 
                            <p>{{$horario->hora_inicio}}</p>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Hora fin</label> 
                            <p>{{$horario->hora_fin}}</p>
                        </div>
                    </div>
                    
                </div>
                <br>
                 
                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Volver</a>
                         
                        </div>
                    </div>
                </div>
         
            </div>
            </div>
        </div>
    </div>
@endsection