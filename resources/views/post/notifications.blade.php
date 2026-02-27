@extends('layouts.admin')

@section('content')

 <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Notificaciones no leídas</div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
          <!-- Añadidos max-height y overflow-y: auto -->

          @if (auth()->user())
            @forelse ($postNotifications as $notification)
            <div class="alert alert-default-warning">
              Título: {{ $notification->data['title'] }}
              <p>Descripción: <br>{{ $notification->data['description']}}</p>
              <p>{{ $notification->created_at->diffForHumans() }}</p>
            </div>
            
            @if ($loop->last)
              <!-- Aquí puedes agregar contenido si es necesario -->
            @endif
            
            @empty
            <div class="alert alert-info">
              No hay notificaciones
            </div>              
            @endforelse
          @endif
                            
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function sendMarkRequest(id = null){
    return $.ajax("{{ route('markNotification') }}", {
      method: 'POST',
      data: {
        _token: "{{ csrf_token() }}",
        id
      }
    });
  }

  $(function(){
    $('.mark-as-read').click(function(){
      let request = sendMarkRequest($(this).data('id'));

      request.done(() => {
        $(this).parents('div.alert').remove();
      });
    });

    $('#mark-all').click(function(){
      let request = sendMarkRequest();

      request.done(() => {
        $('div.alert').remove();
      })
    });
  });
</script>

@endsection