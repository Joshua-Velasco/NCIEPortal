@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Notificación General</h3>
        <small>Esta notificación llegará a admin, alumno, gestor y administrativo</small>
    </div>
    <div class="card-body">
        <form action="{{route('post.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="title" placeholder="Escribe tu titulo aquí" required>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                 <textarea name="description" class="form-control" required> </textarea>
            </div>
            <button class="btn btn-primary" type="submit">Enviar a roles generales</button>
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h3>Notificación para Usuarios</h3>
        <small>Esta notificación llegará solo a usuarios con rol "usuario"</small>
    </div>
    <div class="card-body">
        <form action="{{route('post.store')}}" method="POST">
            @csrf
            <input type="hidden" name="for_users_only" value="1">
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" class="form-control" name="title" placeholder="Escribe tu titulo aquí" required>
            </div>
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="description" class="form-control" required> </textarea>
            </div>
            <button class="btn btn-success" type="submit">Enviar solo a usuarios</button>
        </form>
    </div>
</div>

@endsection