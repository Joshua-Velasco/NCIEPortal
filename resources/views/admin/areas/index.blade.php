<!-- Vista de listado de areas-->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de áreas</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Áreas registradas</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/areas/create')}}" class="btn btn-primary">
                              Registrar nuevo
                        </a>
                    </div>
                 </div>

                 <div class="card-body">
                    
 <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
  <thead>
    <tr>
       <td style="text-align: center"><b>Nro</b></td>
       <td style="text-align: center"><b>Área</b></td>
        <td style="text-align: center"><b>Descripción</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
          @foreach ($areas as $area)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$area->nombre}}</td>
                <td>{{$area->descripcion}}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('admin/areas/'.$area->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{url('admin/areas/'.$area->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/areas/'.$area->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Áreas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Áreas",
                                    "infoFiltered": "(Filtrado de _MAX_ total Áreas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Áreas",
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