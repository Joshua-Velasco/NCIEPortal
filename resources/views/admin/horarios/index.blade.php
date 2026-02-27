<!-- Vista de listado de horarios-->

@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Listado de horarios</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Horarios registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
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
       <td style="text-align: center"><b>Área</b></td>
       <td style="text-align: center"><b>Días de atención</b></td>
        <td style="text-align: center"><b>Hora inicio</b></td>
        <td style="text-align: center"><b>Hora fin</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
          @foreach ($horarios as $horario)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$horario->gestor->nombres." ".$horario->gestor->apellidos}}</td>
                <td>{{$horario->area->nombre}}</td>
                <td>{{$horario->dia}}</td>
                <td style="text-align: center">{{$horario->hora_inicio}}</td>
                <td style="text-align: center">{{$horario->hora_fin}}</td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{url('admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/horarios/'.$horario->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Horarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Horarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Horarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Horarios",
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
<br>


 <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                   <div class="row">
                    <div class="col-md-6"> <h3 class="card-title">Calendario de atención de gestores</h3> </div>
                    <div class="col-md-6"> 
                            <label for="">Área</label>
                            <select name="area_id" id="area_select" class="form-control">
                               <!-- <option value="">Seleccione un area...</option> -->
                                @foreach($areas as $area)
                                <option value="{{$area->id}}" {{$area->id == $selectedAreaId ? 'selected' : ''}}>
                                    {{$area->nombre}}
                                </option>
                                @endforeach
                            </select>
                    </div>
                   </div>
                 </div>

<div class="card-body">
                
                    <script>
                        $(document).ready(function() {
                            // Función para cargar los datos del área
                            function cargarDatosArea() {
                                var area_id = $('#area_select').val();
                            

                                if(area_id) {
                                    $.ajax({
                                        url: "{{url('/admin/horarios/areas/')}}" + '/' + area_id,
                                        type: 'GET',
                                        success: function(data) {
                                            $('#area_info').html(data);
                                        },
                                        error: function() {
                                            alert('Error al obtener los datos del área');
                                        }
                                    });
                                } else {
                                    $('#area_info').html('');
                                }
                            }

                            // Cargar datos al cambiar el select
                            $('#area_select').on('change', cargarDatosArea);

                            // Cargar datos automáticamente al entrar a la página
                            cargarDatosArea();
                        });
                    </script>
                            <hr>   
                        <div id="area_info">

                        </div>
    </div>
             

</div>
            </div>
        </div>

 
    
@endsection