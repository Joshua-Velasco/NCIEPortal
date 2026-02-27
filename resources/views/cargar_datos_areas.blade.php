<h3><center> <b>Horario de atención de {{$area->nombre}}</b> </center></h3>
<hr>
 <table class="table table-striped table-bordered table-hover table table-bordered">
  <thead>
    <tr style="text-align: center">
       <th>Nombre del gestor</th>
       <th>Lunes</th>
       <th>Martes</th>
       <th>Miércoles</th>
       <th>Jueves</th>
       <th>Viernes</th>
    </tr>
  </thead>
  <tbody>  
       @foreach($horarios as $gestorId => $horariosGestor)
          @php
              $gestor = $horariosGestor->first()->gestor;
          @endphp
          <tr>
              <td>{{ $gestor->nombres }} {{ $gestor->apellidos }}</td>
              @foreach(['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'] as $dia)
              <td style="text-align: center">
                  @php
                      $horarioDia = $horariosGestor->filter(function($horario) use ($dia) {
                          return in_array($dia, explode(',', $horario->dia));
                      })->first();
                  @endphp
                  
                  @if($horarioDia)
                      {{ date('h:i a', strtotime($horarioDia->hora_inicio)) }} - 
                      {{ date('h:i a', strtotime($horarioDia->hora_fin)) }}
                  @else
                      -
                  @endif
              </td>
              @endforeach
          </tr>
      @endforeach
  </tbody>
</table>