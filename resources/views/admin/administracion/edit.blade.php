<!-- Vista formulario editar administrativo -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar administrativo: {{$administrativo->nombres}} {{$administrativo->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/administracion', $administrativo->id)}}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Nombres</label> <b>*</b>
                            <input type="text" value="{{$administrativo->nombres}}" name="nombres" class="form-control" required>
                            @error('nombres')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Apellidos</label> <b>*</b>
                            <input type="text" value="{{$administrativo->apellidos}}" name="apellidos" class="form-control" required>
                            @error('apellidos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="form group">
                            <label for="">Teléfono</label> <b>*</b>
                            <input type="text" value="{{$administrativo->telefono}}" name="telefono" class="form-control" required>
                            @error('telefono')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">Carrera</label> <b>*</b>
                            <input type="text" value="{{$administrativo->carrera}}" name="carrera" class="form-control" required>
                            @error('carrera')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-4">
                        <div class="form group">
                            <label for="">Grado Académico</label> <b>*</b>
                            <input type="text" value="{{$administrativo->grado_academico}}" name="grado_academico" class="form-control" required>
                            @error('grado_academico')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Correo electrónico</label>
                            <input type="email" value="{{$administrativo->user->email}}" name="email" class="form-control" required>
                            @error('email')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-4">
                        <div class="form group">
                            <label for="">Contraseña</label>
                            <input type="password" value="{{old('password')}}" name="password" class="form-control">                      
                            @error('password')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4">
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
                            <a href="{{url('admin/administracion')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar administrativo</button>
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