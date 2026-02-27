<!-- Vista de listado de usuarios -->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de usuarios</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Usuarios registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/usuarios/create')}}" class="btn btn-primary">
                              Registrar nuevo
                        </a>
                    </div>
                 </div>

                 <div class="card-body">
                    
 <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
  <thead>
    <tr>
       <td style="text-align: center"><b>Nro</b></td>
       <td style="text-align: center"><b>Nombre</b></td>
       <td style="text-align: center"><b>Correo</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
          @foreach ($usuarios as $usuario)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$usuario->name}}</td>
                <td>{{$usuario->email}}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('admin/usuarios/'.$usuario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{url('admin/usuarios/'.$usuario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/usuarios/'.$usuario->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Usuarios",
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