@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Mis Proyectos</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Proyectos asignados</h3>
                </div>

                <div class="card-body">
                    @if(isset($error))
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                    @endif

                    @if($proyectos->isEmpty())
                        <div class="alert alert-info text-center">
                            No tienes proyectos asignados actualmente.
                        </div>
                    @else
                        <div class="row">
                            @foreach($proyectos as $asignacion)
                                @if($asignacion->proyecto)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <!-- Imagen del proyecto -->
                                            @if($asignacion->proyecto->fotos)
                                                <img src="{{ asset($asignacion->proyecto->fotos) }}" 
                                                     class="card-img-top" 
                                                     alt="{{ $asignacion->proyecto->nombre }}"
                                                     style="height: 200px; object-fit: cover;">
                                            @else
                                                <div class="text-center py-5 bg-light">
                                                    <i class="bi bi-image" style="font-size: 3rem; color: #6c757d;"></i>
                                                    <p class="mt-2">Sin imagen</p>
                                                </div>
                                            @endif

                                            <div class="card-body">
                                                <!-- Nombre del proyecto -->
                                                <h5 class="card-title">{{ $asignacion->proyecto->nombre }}</h5>
                                                
                                                <!-- Descripción del proyecto -->
                                                @if($asignacion->proyecto->descripcion)
                                                    <p class="card-text">{{ Str::limit($asignacion->proyecto->descripcion, 100) }}</p>
                                                @endif
                                                
                                                <!-- Detalles de la asignación -->
                                                <div class="assignment-details mt-3">
                                                    <div class="detail-item">
                                                        <strong>Tipo:</strong>
                                                        <span class="badge 
                                                            @switch($asignacion->tipo)
                                                                @case('residencias') bg-primary @break
                                                                @case('servicio_social') bg-success @break
                                                                @default bg-info
                                                            @endswitch">
                                                            {{ ucfirst(str_replace('_', ' ', $asignacion->tipo)) }}
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="detail-item">
                                                        <strong>Fecha Inicio:</strong>
                                                        <span>{{ $asignacion->fecha_inicio ? \Carbon\Carbon::parse($asignacion->fecha_inicio)->format('d/m/Y') : 'No especificada' }}</span>
                                                    </div>
                                                    
                                                    <div class="detail-item">
                                                        <strong>Fecha Fin:</strong>
                                                        <span>{{ $asignacion->fecha_fin ? \Carbon\Carbon::parse($asignacion->fecha_fin)->format('d/m/Y') : 'No especificada' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .assignment-details {
            border-top: 1px solid #eee;
            padding-top: 10px;
            margin-top: 15px;
        }
        .detail-item {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }
        .detail-item strong {
            margin-right: 10px;
        }
        .card-text {
            color: #555;
            font-size: 0.9rem;
        }
    </style>
    @endpush
@endsection