@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="col-md-6" >
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3>Registrarse a un curso</h3>
        </div>
        <div class="card-body">
            @if($cursosDisponibles->isEmpty())
                <div class="alert alert-info">
                    No hay cursos disponibles en este momento.
                </div>
            @else
                <form action="{{ route('inscripciones.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="curso_id">Selecciona un curso:</label>
                        <select name="curso_id" id="curso_id" class="form-control" required>
                            @foreach($cursosDisponibles as $curso)
                                <option value="{{ $curso->id }}">
                                    {{ $curso->nombre }} ({{ $curso->hora_inicio }} - {{ $curso->hora_fin }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                     <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('/admin')}}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Registrarse</button>
                        </div>
                    </div>
                </div>
                    
                </form>
            @endif
        </div>
    </div>
    </div>
</div>
@endsection