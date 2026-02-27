@extends('layouts.admin')
@section('content')
    <div class="row">
        <h1>Mis Cursos Inscritos</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Cursos inscritos</h3>
                 </div>

                 <div class="card-body">
                    @if($inscripciones->isEmpty())
                        <div class="alert alert-info text-center">
                            No estás inscrito en ningún curso actualmente.
                        </div>
                    @else
                        <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
                            <thead>
                                <tr>
                                    <td style="text-align: center"><b>Nro</b></td>
                                    <td style="text-align: center"><b>Nombre del Curso</b></td>
                                    <td style="text-align: center"><b>Acciones</b></td>
                                </tr>
                            </thead>
                            <tbody>  
                                <?php $contador = 1; ?>
                                @foreach($inscripciones as $inscripcion)
                                <tr>
                                    <td style="text-align: center">{{$contador++}}</td>
                                    <td>{{ $inscripcion->curso->nombre }}</td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form id="form-abandonar-{{$inscripcion->id}}" action="{{ route('inscripciones.destroy', $inscripcion->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm btn-abandonar" data-id="{{$inscripcion->id}}">
                                                    <i class="bi bi-trash"></i> Abandonar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Cursos",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Cursos",
                                    "infoFiltered": "(Filtrado de _MAX_ total Cursos)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Cursos",
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

                        
                         $(document).ready(function() {
        $('.btn-abandonar').click(function(e) {
            e.preventDefault();
            let formId = $(this).data('id');
            
            Swal.fire({
                title: 'Sistema NCIE dice',
                text: '¿Estás seguro de que deseas abandonar este curso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-abandonar-'+formId).submit();
                }
            });
        });
    });
                    </script>
                 </div>
            </div>
        </div>
    </div>
@endsection