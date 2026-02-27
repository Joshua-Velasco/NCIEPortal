<!-- Vista formulario editar usuario -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar usuario: {{$usuario->name}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('admin/usuarios', $usuario->id)}}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Nombre del usuario</label> <b>*</b>
                            <input type="text" value="{{$usuario->name}}" name="name" class="form-control" required>
                            @error('name')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Correo electrónico</label> <b>*</b>
                            <input type="email" value="{{$usuario->email}}" name="email" class="form-control" required>
                            @error('email')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Contraseña</label>
                            <input type="password" value="{{old('password')}}" name="password" class="form-control">
                            @error('password')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Contraseña verificación</label> 
                            <input type="password" name="password_confirmation" class="form-control">
                             @error('password_confirmation')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/usuarios')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar usuario</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
        <script>
        document.querySelector('input[name="password"]').addEventListener('input', function(e) {
    const password = e.target.value;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const isValid = password.length >= 8 && hasUpperCase && hasNumber;
    
    if (isValid) {
        e.target.style.borderColor = 'green';
    } else {
        e.target.style.borderColor = 'red';
    }
});
    </script>
@endsection