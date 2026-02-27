<!-- Vista formulario editar alumno -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Modificar alumno: {{$alumno->nombres." ".$alumno->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/alumnos',$alumno->id)}}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Nombres</label> <b>*</b>
                            <input type="text" value="{{$alumno->nombres}}" name="nombres" class="form-control" required>
                            @error('nombres')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Apellidos</label> <b>*</b>
                            <input type="text" value="{{$alumno->apellidos}}" name="apellidos" class="form-control" required>
                            @error('apellidos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de nacimiento</label> <b>*</b>
                            <input type="date" value="{{$alumno->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" required>
                            @error('fecha_nacimiento')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Celular</label> <b>*</b>
                            <input type="tel" value="{{$alumno->celular}}" name="celular" class="form-control"  pattern="[0-9]{10}" 
                             title="Ingresa un número de 10 dígitos (sin guiones o espacios)" required>
                            @error('celular')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Numero de control</label> <b>*</b>
                            <input type="number" value="{{$alumno->numero_control}}" name="numero_control" class="form-control" pattern="[0-9]{8}" required>
                            @error('numero_control')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form group">
                            <label for="">Carrera</label> <b>*</b>
                            <input type="text" value="{{$alumno->carrera}}" name="carrera" class="form-control" required>
                            @error('carrera')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                        </div>
                          <div class="col-md-3">
                         <div class="form group">
                            <label for="">Semestre</label> <b>*</b>
                            <input type="number" value="{{$alumno->semestre}}" name="semestre" class="form-control" pattern="[0-9]{1}" required>
                            @error('semestre')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-3">
                        <div class="form group">
                            <label for="">Correo electrónico</label> <b>*</b>
                            <input type="email" value="{{$alumno->user->email}}" name="email" class="form-control" required>
                            @error('email')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Contraseña</label>
                            <input type="password" value="{{old('password')}}" name="password" class="form-control">
                            @error('password')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
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
                            <a href="{{url('admin/alumnos')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar alumno</button>
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