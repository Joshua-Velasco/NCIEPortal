@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Mis Proyectos Asignados</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Proyectos asignados</h3>
                 </div>

                 <div class="card-body">
                    @if($proyectos->isEmpty())
                        <div class="alert alert-info text-center">
                            No tienes proyectos asignados actualmente.
                        </div>
                    @else
                        <div class="row">
                            @foreach($proyectos as $proyecto)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    @if($proyecto->fotos)
                                    <img src="{{ asset($proyecto->fotos) }}" class="card-img-top" alt="{{ $proyecto->nombre }}" style="height: 200px; object-fit: cover;">
                                    @else
                                    <div class="text-center py-5 bg-light">
                                        <i class="bi bi-image" style="font-size: 3rem; color: #6c757d;"></i>
                                        <p class="mt-2">Sin imagen</p>
                                    </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $proyecto->nombre }}</h5>
                                        <p class="card-text">{{ Str::limit($proyecto->descripcion, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                 </div>
            </div>
        </div>
    </div>
@endsection