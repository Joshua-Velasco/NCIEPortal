<!-- Vista formulario crear proyectos -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de un nuevo proyecto</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/proyectos/create')}}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Nombre del proyecto</label> <b>*</b>
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
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Fotos</label>
                            <input type="file" class="form-control" name="fotos" placeholder="Escriba aqui..." onchange="mostrarImagen(event)" accept="image/*">
                            <br>

                            @error('fotos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                        <script>
                            const mostrarImagen = e =>
                                document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
                        </script>
                    </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/proyectos')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar proyecto</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection