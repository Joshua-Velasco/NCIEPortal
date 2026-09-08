@php
  $dias = ['LUNES' => ['Lunes', 'Lun'], 'MARTES' => ['Martes', 'Mar'], 'MIERCOLES' => ['Miércoles', 'Mié'], 'JUEVES' => ['Jueves', 'Jue'], 'VIERNES' => ['Viernes', 'Vie']];
  $hoy = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO'][\Carbon\Carbon::now()->dayOfWeekIso - 1];
  $hora = fn ($h) => \Carbon\Carbon::parse($h)->format('G:i');
@endphp
@if ($horarios->isEmpty())
  <div class="schedule-empty">
    <p>Esta área todavía no tiene horarios publicados. Escríbenos a <a href="mailto:ncie@itcj.edu.mx">ncie@itcj.edu.mx</a> para agendar una visita.</p>
  </div>
@else
  <div class="table-scroll">
    <table class="schedule-table">
      <thead>
        <tr>
          <th scope="col">Gestor</th>
          @foreach ($dias as $clave => $nombreDia)
            <th scope="col" class="{{ $clave === $hoy ? 'is-today' : '' }}">
              <span class="d-long">{{ $nombreDia[0] }}</span><span class="d-short">{{ $nombreDia[1] }}</span>
              @if ($clave === $hoy)<em>Hoy</em>@endif
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($horarios as $horariosGestor)
          @php $gestor = $horariosGestor->first()->gestor; @endphp
          <tr>
            <th scope="row">
              <strong>{{ $gestor?->nombres }} {{ $gestor?->apellidos }}</strong>
              @if ($gestor?->grado_academico || $gestor?->carrera)<small>{{ $gestor->grado_academico ?: $gestor->carrera }}</small>@endif
            </th>
            @foreach ($dias as $clave => $nombreDia)
              @php
                $h = $horariosGestor->first(fn ($x) => in_array($clave, array_map('trim', explode(',', $x->dia))));
              @endphp
              <td class="{{ $clave === $hoy ? 'is-today' : '' }}">
                @if ($h)
                  <span class="slot">{{ $hora($h->hora_inicio) }} a {{ $hora($h->hora_fin) }}</span>
                @else
                  <span class="slot slot--off" role="img" aria-label="Sin atención">—</span>
                @endif
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endif
