@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de Asignaciones Proyecto-Gestor</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Gestores correspondientes a proyectos</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/proyecto_gestores/create')}}" class="btn btn-primary">
                              Registrar nuevo
                        </a>
                    </div>
                 </div>

                 <div class="card-body">
                    
 <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
  <thead>
    <tr>
       <td style="text-align: center"><b>Nro</b></td>
       <td style="text-align: center"><b>Gestor</b></td>
        <td style="text-align: center"><b>Proyecto Asignado</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
           @foreach($proyectosConGestores as $proyecto)
            @foreach($proyecto->gestores as $gestor)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{ $gestor->nombres }} {{ $gestor->apellidos }}</td>
                <td>{{ $proyecto->nombre }}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      
                        <a href="{{url('admin/proyecto_gestores/'.$gestor->pivot->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/proyecto_gestores/'.$gestor->pivot->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        @endforeach
  </tbody>
</table>
<script>
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Asignaciones",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Asignaciones",
                                    "infoFiltered": "(Filtrado de _MAX_ total Asignaciones)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Asignaciones",
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