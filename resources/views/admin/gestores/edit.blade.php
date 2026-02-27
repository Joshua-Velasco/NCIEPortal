<!-- Vista formulario editar gestor -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Gestor: {{$gestor->nombres." ".$gestor->apellidos}}</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
                <form action="{{url('admin/gestores', $gestor->id)}}" method="POST">
                @csrf
                @method('PUT')
                 <div class="row">
                    <div class="col-md-3">
                        <div class="form group">
                            <label for="">Nombres</label> <b>*</b>
                            <input type="text" value="{{$gestor->nombres}}" name="nombres" class="form-control" required>
                            @error('nombres')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Apellidos</label> <b>*</b>
                            <input type="text" value="{{$gestor->apellidos}}" name="apellidos" class="form-control" required>
                            @error('apellidos')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Fecha de nacimiento</label> <b>*</b>
                            <input type="date" value="{{$gestor->fecha_nacimiento}}" name="fecha_nacimiento" class="form-control" required>
                            @error('fecha_nacimiento')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form group">
                            <label for="">Celular</label> <b>*</b>
                            <input type="tel" value="{{$gestor->celular}}" name="celular" class="form-control"  pattern="[0-9]{10}" 
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
                            <label for="">Carrera</label> <b>*</b>
                            <input type="text" value="{{$gestor->carrera}}" name="carrera" class="form-control" required>
                            @error('carrera')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Grado ácademico</label> <b>*</b>
                            <input type="text" value="{{$gestor->grado_academico}}" name="grado_academico" class="form-control" required>
                            @error('grado_academico')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                      <div class="col-md-3">
                        <div class="form group">
                            <label for="">Correo electrónico</label> <b>*</b>
                            <input type="email" value="{{$gestor->user->email}}" name="email" class="form-control" required>
                            @error('email')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                          <div class="col-md-3">
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
                            <a href="{{url('admin/gestores')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Actualizar gestor</button>
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