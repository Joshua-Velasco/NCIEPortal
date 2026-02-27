@extends('layouts.admin')
@section('content')
<div class="row">
        <h1>Usuarios inscritos</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Usuarios inscritos</h3>
                 </div>

                 <div class="card-body">
                    @if($cursos->isEmpty())
                        <div class="alert alert-info text-center">
                            No tienes cursos asignados actualmente.
                        </div>
                    @else
                        <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
                            <thead>
                                <tr>
                                    <td style="text-align: center"><b>Nro</b></td>
                                    <td style="text-align: center"><b>Nombre del Curso</b></td>
                                    <td style="text-align: center"><b>Usuarios inscritos al curso</b></td>
                                    <td style="text-align: center"><b>Correo</b></td>
                                     <td style="text-align: center"><b>Fecha de registro</b></td>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php $contador = 1; ?>
                                @foreach($cursos as $curso)
                                    @if($curso->alumnos->isEmpty())
                                        <tr>
                                            <td style="text-align: center">{{$contador++}}</td>
                                            <td>{{ $curso->nombre }}</td>
                                            <td colspan="2" style="text-align: center; color: #dc3545;">No hay usuarios inscritos</td>
                                        </tr>
                                    @else
                                        @foreach($curso->alumnos as $alumno)
                                        <tr>
                                            <td style="text-align: center">{{$contador++}}</td>
                                            <td>{{ $curso->nombre }}</td>
                                            <td>{{ $alumno->name }}</td>
                                            <td>{{ $alumno->email }}</td>
                                             <td>{{ $alumno->pivot->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endif
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