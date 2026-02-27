<!-- Vista ver proyectos-->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Proyecto: {{ $proyectos->nombre }}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header"> 
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombre">Nombre del proyecto</label>
                                    <p>{{ $proyectos->nombre }}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <p>{{ $proyectos->descripcion }}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fotos">Fotografía</label>
                                    <center>
                                            <img id="preview" src="{{ asset($proyectos->fotos) }}" alt="Imagen del proyecto" class="img-fluid img-thumbnail" style="max-width: 200px; margin-top: 10px;">
                                    </center>
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
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection