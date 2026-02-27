<!-- Vista formulario editar horario -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Horario</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('admin/horarios', $horario->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Gestor</label> <b>*</b>
                                <select name="gestor_id" class="form-control">
            @foreach($gestores as $gestor)
                <option value="{{ $gestor->id }}" {{ $gestor->id == $horario->gestor_id ? 'selected' : '' }}>
                    {{ $gestor->nombres }} {{ $gestor->apellidos }}
                </option>
            @endforeach
        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Área</label> <b>*</b>
                            <select name="area_id" class="form-control">
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}" 
                                                {{ ($area->id == $horario->area_id) ? 'selected' : '' }}>
                                                {{$area->nombre}}
                                            </option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                 </div>
                    <br>
                 <div class="row">
                    
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Días</label> <b>*</b>
                            <div class="form-check form-switch">
                                        @php
                                            $diasSeleccionados = explode(',', $horario->dia);
                                        @endphp
                                        
                                        <input class="form-check-input" type="checkbox" name="dia[]" value="LUNES" id="lunes" {{ in_array('LUNES', $diasSeleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lunes">LUNES</label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="dia[]" value="MARTES" id="martes" {{ in_array('MARTES', $diasSeleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="martes">MARTES</label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="dia[]" value="MIERCOLES" id="miercoles" {{ in_array('MIERCOLES', $diasSeleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="miercoles">MIERCOLES</label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="dia[]" value="JUEVES" id="jueves" {{ in_array('JUEVES', $diasSeleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jueves">JUEVES</label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="dia[]" value="VIERNES" id="viernes" {{ in_array('VIERNES', $diasSeleccionados) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="viernes">VIERNES</label>
                                    </div>
                                </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Hora inicio</label> <b>*</b>
                            <input type="time" value="{{$horario->hora_inicio}}" name="hora_inicio" class="form-control" required>
                            @error('hora_inicio')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Hora fin</label> <b>*</b>
                            <input type="time" value="{{$horario->hora_fin}}" name="hora_fin" class="form-control" required>
                            @error('hora_fin')
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
                            <a href="{{url('admin/horarios')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar horario</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection