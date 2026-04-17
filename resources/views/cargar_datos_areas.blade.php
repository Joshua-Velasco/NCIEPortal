<div class="table-responsive gestores-table-wrapper" data-aos="fade-up">
    <table class="table table-hover align-middle custom-gestores-table">
        <thead>
            <tr>
                <th class="ps-4">Gestor Especialista</th>
                <th class="text-center">Lunes</th>
                <th class="text-center">Martes</th>
                <th class="text-center">Miércoles</th>
                <th class="text-center">Jueves</th>
                <th class="text-center">Viernes</th>
            </tr>
        </thead>
        <tbody>
            @forelse($horarios as $gestorId => $horariosGestor)
                @php
                    $gestor = $horariosGestor->first()->gestor;
                @endphp
                <tr>
                    <td class="ps-4">
                        <div class="gestor-profile">
                            <div class="gestor-avatar-circle">
                                {{ strtoupper(substr($gestor->nombres, 0, 1)) }}{{ strtoupper(substr($gestor->apellidos, 0, 1)) }}
                            </div>
                            <div class="gestor-info">
                                <span class="gestor-name">{{ $gestor->nombres }} {{ $gestor->apellidos }}</span>
                                <span class="gestor-role">Especialista en {{ $area->nombre }}</span>
                            </div>
                        </div>
                    </td>
                    @foreach(['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES'] as $dia)
                        <td class="text-center" data-label="{{ ucfirst(strtolower($dia)) }}">
                            @php
                                $horarioDia = $horariosGestor->filter(function($horario) use ($dia) {
                                    return in_array($dia, explode(',', $horario->dia));
                                })->first();
                            @endphp
                            
                            @if($horarioDia)
                                <div class="time-slot-badge">
                                    <i class="bi bi-clock-history me-1"></i>
                                    {{ date('h:i', strtotime($horarioDia->hora_inicio)) }} - 
                                    {{ date('h:i a', strtotime($horarioDia->hora_fin)) }}
                                </div>
                            @else
                                <span class="text-muted opacity-25">—</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="no-data-state py-4">
                            <i class="bi bi-calendar-x fs-1 opacity-25 mb-3 d-block"></i>
                            <h6 class="text-muted fw-bold">Sin gestores disponibles</h6>
                            <p class="text-muted small mb-0 px-4">Actualmente no hay gestores con horarios asignados en el área de {{ $area->nombre }}.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>