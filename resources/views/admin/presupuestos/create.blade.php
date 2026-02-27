@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Registro de un nuevo presupuesto</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header"> 
                    <h3 class="card-title">Llene los datos</h3>
                </div>
                 <div class="card-body">
               <form action="{{url('/admin/presupuestos/create')}}" method="POST">
                @csrf
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Motivo</label> <b>*</b>
                            <textarea name="motivo" class="form-control" required>{{old('motivo')}}</textarea>
                            @error('motivo')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Monto</label> <b>*</b>
                            <input type="number" step="0.01" value="{{old('monto')}}" name="monto" class="form-control" required>
                            @error('monto')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <label for="">Fecha</label> <b>*</b>
                            <input type="date" value="{{old('fecha')}}" name="fecha" class="form-control" required>
                            @error('fecha')
                                <small style="color: red">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form group">
                            <a href="{{url('admin/presupuestos')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Registrar presupuesto</button>
                        </div>
                    </div>
                </div>
               </form>
            </div>
            </div>
        </div>
    </div>
@endsection