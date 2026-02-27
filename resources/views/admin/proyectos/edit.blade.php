<!-- Vista formulario editar proyectos-->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Actualización del proyecto: {{ $proyectos->nombre }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/proyectos', $proyectos->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre del proyecto</label> <b>*</b>
                                    <input type="text" value="{{ $proyectos->nombre }}" name="nombre" class="form-control" required>
                                    @error('nombre')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label> <b>*</b>
                                    <input type="text" value="{{ $proyectos->descripcion }}" name="descripcion" class="form-control" required>
                                    @error('descripcion')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fotos">Fotografía</label>
                                    
                                    @if($proyectos->fotos)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="eliminar_imagen" id="eliminar_imagen">
                                            <label class="form-check-label text-danger" for="eliminar_imagen">
                                                Eliminar imagen actual
                                            </label>
                                        </div>
                                    @endif
                                    
                                    <input type="file" class="form-control" name="fotos" id="fotos" onchange="mostrarImagen(event)" accept="image/*">
                                    <br>

                                    <center>
                                        @if($proyectos->fotos)
                                            <img id="preview" src="{{ asset($proyectos->fotos) }}" alt="Imagen del proyecto" class="img-fluid img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                                        @else
                                            <img id="preview" src="" alt="Previsualización de imagen" class="img-fluid img-thumbnail" style="max-width: 200px; margin-top: 10px; display: none;">
                                        @endif
                                    </center>

                                    @error('fotos')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                                <script>
                                    function mostrarImagen(event) {
                                        const preview = document.getElementById('preview');
                                        preview.src = URL.createObjectURL(event.target.files[0]);
                                        preview.style.display = 'block';
                                    }
                                </script>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ url('admin/proyectos') }}" class="btn btn-secondary">Cancelar</a>
                                    <button type="submit" class="btn btn-success">Actualizar proyecto</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection