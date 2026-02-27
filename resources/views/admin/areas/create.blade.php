<!-- Vista formulario crear áreas -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de una nueva área</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/areas/create')}}" method="POST">
                @csrf
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Nombre del área</label> <b>*</b>
                            <input type="text" value="{{old('nombre')}}" name="nombre" class="form-control" required>
                            @error('nombre')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Descripción</label> <b>*</b>
                            <input type="text" value="{{old('descripcion')}}" name="descripcion" class="form-control" required>
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
                            <a href="{{url('admin/areas')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar área</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection