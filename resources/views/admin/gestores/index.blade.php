<!-- Vista de listado de gestores-->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de gestores</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Gestores registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/gestores/create')}}" class="btn btn-primary">
                              Registrar nuevo
                        </a>
                    </div>
                 </div>

                 <div class="card-body">
                    
 <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
  <thead>
    <tr>
       <td style="text-align: center"><b>Nro</b></td>
       <td style="text-align: center"><b>Nombres</b></td>
        <td style="text-align: center"><b>Apellidos</b></td>
        <td style="text-align: center"><b>Fecha de nacimiento</b></td>
        <td style="text-align: center"><b>Celular</b></td>
        <td style="text-align: center"><b>Carrera</b></td>
        <td style="text-align: center"><b>Grado ácademico</b></td>
        <td style="text-align: center"><b>Correo</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
          @foreach ($gestores as $gestor)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$gestor->nombres}}</td>
                <td>{{$gestor->apellidos}}</td>
                <td>{{$gestor->fecha_nacimiento}}</td>
                <td>{{$gestor->celular}}</td>
                <td>{{$gestor->carrera}}</td>
                <td>{{$gestor->grado_academico}}</td>
                <td>{{$gestor->user->email}}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('admin/gestores/'.$gestor->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{url('admin/gestores/'.$gestor->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/gestores/'.$gestor->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
  </tbody>
</table>
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Gestores",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Gestores",
                                    "infoFiltered": "(Filtrado de _MAX_ total Gestores)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Gestores",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                 </div>
            </div>
        </div>
    </div>
@endsection