@extends('layouts.admin')
@section('content')
    <style>
        .image-preview-container {
            position: absolute;
            display: none;
            z-index: 1000;
            background: white;
            padding: 5px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .image-preview-container img {
            max-width: 300px;
            max-height: 300px;
        }
    </style>

    <div class="row">
        <h1>Listado de proyectos</h1>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                 <div class="card-header">
                    <h3 class="card-title">Proyectos registrados</h3>
                    <div class="card-tools">
                        <a href="{{url('admin/proyectos/create')}}" class="btn btn-primary">
                              Registrar nuevo
                        </a>
                    </div>
                 </div>

                 <div class="card-body">
                    
 <table id="example1" class="table table-striped table-bordered table-hover table table-sm">
  <thead>
    <tr>
       <td style="text-align: center"><b>Nro</b></td>
       <td style="text-align: center"><b>Nombre del proyecto</b></td>
        <td style="text-align: center"><b>Descripción</b></td>
        <td style="text-align: center"><b>Fotos</b></td>
       <td style="text-align: center"><b>Acciones</b></td>
    </tr>
  </thead>
  <tbody>  
         <?php $contador = 1; ?>
          @foreach ($proyectos as $proyecto)
            <tr>
                <td style="text-align: center">{{$contador++}}</td>
                <td>{{$proyecto->nombre}}</td>
                <td>{{$proyecto->descripcion}}</td>
                <td>
                    @if($proyecto->fotos)
                        <a href="#" class="image-preview" data-image="{{ asset($proyecto->fotos) }}">
                            Ver foto
                        </a>
                    @else
                        Sin foto
                    @endif
                </td>
                <td style="text-align: center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{url('admin/proyectos/'.$proyecto->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye"></i></a>
                        <a href="{{url('admin/proyectos/'.$proyecto->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i></a>
                        <a href="{{url('admin/proyectos/'.$proyecto->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proyectos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proyectos",
                "infoFiltered": "(Filtrado de _MAX_ total Proyectos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proyectos",
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

    // Script para mostrar la imagen al pasar el mouse
    document.addEventListener('DOMContentLoaded', function() {
        // Crear contenedor para la previsualización
        const previewContainer = document.createElement('div');
        previewContainer.className = 'image-preview-container';
        document.body.appendChild(previewContainer);
        
        // Agregar evento a todos los enlaces de previsualización
        document.querySelectorAll('.image-preview').forEach(link => {
            link.addEventListener('mouseenter', function(e) {
                const imgUrl = this.getAttribute('data-image');
                previewContainer.innerHTML = `<img src="${imgUrl}" alt="Preview">`;
                
                // Posicionar el contenedor cerca del mouse
                previewContainer.style.display = 'block';
                previewContainer.style.left = (e.pageX + 10) + 'px';
                previewContainer.style.top = (e.pageY + 10) + 'px';
            });
            
            link.addEventListener('mouseleave', function() {
                previewContainer.style.display = 'none';
            });
            
            // Mover la previsualización con el mouse
            link.addEventListener('mousemove', function(e) {
                previewContainer.style.left = (e.pageX + 10) + 'px';
                previewContainer.style.top = (e.pageY + 10) + 'px';
            });
        });
    });
</script>
                 </div>
            </div>
        </div>
    </div>
@endsection