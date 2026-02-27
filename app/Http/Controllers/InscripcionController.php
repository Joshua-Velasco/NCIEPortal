<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;


class InscripcionController extends Controller
{
    public function create()
    {
        $userId = auth()->id();

        // Cursos con gestores asignados y que no hayan finalizado
        $cursosDisponibles = Curso::whereHas('gestores')
            ->whereDoesntHave('inscripciones', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where('fecha_fin', '>', now()) // Que no hayan terminado
            ->orderBy('fecha_inicio')
            ->get();

        return view('inscripciones.create', compact('cursosDisponibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id'
        ]);

        $userId = auth()->id();
        $cursoId = $request->curso_id;
        $cursoNuevo = Curso::findOrFail($cursoId);

        // 1. Verificar si el curso ya comenzó hace más de 2 días
        if ($cursoNuevo->fecha_inicio <= now()->subDays(2)) {
            return redirect()->back()
                ->with('mensaje', 'No puedes registrarte a este curso porque ya comenzó hace más de 2 días')
                ->with('icono', 'warning');
        }

        // 2. Verificar si ya está registrado en este curso
        if (Inscripcion::where('user_id', $userId)->where('curso_id', $cursoId)->exists()) {
            return redirect()->back()
                ->with('mensaje', 'Ya estás registrado en este curso')
                ->with('icono', 'warning');
        }

        // 3. Verificar conflictos de horario con otros cursos inscritos
        $cursosInscritos = Inscripcion::with('curso')
            ->where('user_id', $userId)
            ->get()
            ->pluck('curso');

        foreach ($cursosInscritos as $cursoExistente) {
            // Verificar superposición de fechas
            $solapamientoFechas = (
                $cursoNuevo->fecha_inicio <= $cursoExistente->fecha_fin &&
                $cursoNuevo->fecha_fin >= $cursoExistente->fecha_inicio
            );

            // Verificar superposición de horarios
            $solapamientoHorarios = (
                $cursoNuevo->hora_inicio < $cursoExistente->hora_fin &&
                $cursoNuevo->hora_fin > $cursoExistente->hora_inicio
            );

            if ($solapamientoFechas && $solapamientoHorarios) {
                return redirect()->back()
                    ->with('mensaje', 'Ya tienes un curso registrado en el mismo horario (' . $cursoExistente->nombre . ')')
                    ->with('icono', 'warning');
            }
        }

        try {
            // Crear la nueva inscripción
            Inscripcion::create([
                'user_id' => $userId,
                'curso_id' => $cursoId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('admin.index')
                ->with('mensaje', 'Te has registrado al curso correctamente')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('mensaje', 'Error al registrar: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    public function misCursos()
    {
        // Obtener solo los cursos del usuario actual que tengan gestores asignados
        $inscripciones = Inscripcion::with(['curso' => function ($query) {
            $query->whereHas('gestores'); // Solo cursos con gestores
        }])
            ->where('user_id', auth()->id())
            ->whereHas('curso.gestores') // Filtro adicional para seguridad
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('inscripciones.mis-cursos', compact('inscripciones'));
    }

    public function destroy($id)
    {
        $inscripcion = Inscripcion::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $inscripcion->delete();

        return back()->with('mensaje', 'Has abandonado el curso exitosamente')
            ->with('icono', 'success');
    }
}
