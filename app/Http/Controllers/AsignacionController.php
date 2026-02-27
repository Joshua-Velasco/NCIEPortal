<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Gestor;
use App\Models\GestorCurso;
use Illuminate\Http\Request;
use App\Notifications\CursoRegistradoNotification;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Gestor::with('cursos')->get();
        return view('admin.asignaciones.index', compact('asignaciones'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestores = Gestor::all();
        $cursos = Curso::all();
        return view('admin.asignaciones.create', compact('gestores', 'cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gestor_id' => 'required|exists:gestores,id',
            'curso_id' => 'required|exists:cursos,id'
        ]);

        // Verificar si ya existe la asignación
        $existeAsignacion = GestorCurso::where('gestor_id', $request->gestor_id)
            ->where('curso_id', $request->curso_id)
            ->exists();

        if ($existeAsignacion) {
            return redirect()->back()
                ->with('mensaje', 'Esta asignación ya existe')
                ->with('icono', 'warning');
        }

        // Validar disponibilidad de horario
        if (!$this->validarDisponibilidad($request->gestor_id, $request->curso_id)) {
            return redirect()->back()
                ->with('mensaje', 'El gestor ya tiene un curso asignado en el mismo horario')
                ->with('icono', 'warning');
        }

        // Crear la asignación
        GestorCurso::create([
            'gestor_id' => $request->gestor_id,
            'curso_id' => $request->curso_id
        ]);


        return redirect()->route('admin.asignaciones.index')
            ->with('mensaje', 'Asignación creada correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($gestorId, $cursoId)
    {
        $asignacion = GestorCurso::with(['gestor', 'curso'])
            ->where('gestor_id', $gestorId)
            ->where('curso_id', $cursoId)
            ->firstOrFail();

        $gestores = Gestor::all();
        $cursos = Curso::all();

        return view('admin.asignaciones.edit', compact('asignacion', 'gestores', 'cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $gestorId, $cursoId)
    {
        $request->validate([
            'gestor_id' => 'required|exists:gestores,id',
            'curso_id' => 'required|exists:cursos,id'
        ]);

        $asignacion = GestorCurso::where('gestor_id', $gestorId)
            ->where('curso_id', $cursoId)
            ->firstOrFail();

        // Solo validar si los IDs cambiaron
        if ($request->gestor_id != $gestorId || $request->curso_id != $cursoId) {
            // Verificar si la nueva combinación ya existe
            $existe = GestorCurso::where('gestor_id', $request->gestor_id)
                ->where('curso_id', $request->curso_id)
                ->exists();

            if ($existe) {
                return redirect()->back()
                    ->with('mensaje', 'Esta asignación ya existe')
                    ->with('icono', 'warning');
            }

            // Validar disponibilidad de horario solo si el curso cambió
            if ($request->curso_id != $cursoId) {
                if (!$this->validarDisponibilidad($request->gestor_id, $request->curso_id, $asignacion)) {
                    return redirect()->back()
                        ->with('mensaje', 'El gestor ya tiene un curso asignado en el mismo horario')
                        ->with('icono', 'warning');
                }
            }
        }

        $asignacion->update([
            'gestor_id' => $request->gestor_id,
            'curso_id' => $request->curso_id
        ]);

        return redirect()->route('admin.asignaciones.index')
            ->with('mensaje', 'Asignación actualizada correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete($gestorId, $cursoId)
    {
        $asignacion = GestorCurso::with(['gestor', 'curso'])
            ->where('gestor_id', $gestorId)
            ->where('curso_id', $cursoId)
            ->firstOrFail();

        return view('admin.asignaciones.delete', compact('asignacion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($gestorId, $cursoId)
    {
        $asignacion = GestorCurso::where('gestor_id', $gestorId)
            ->where('curso_id', $cursoId)
            ->firstOrFail();

        $asignacion->delete();

        return redirect()->route('admin.asignaciones.index')
            ->with('mensaje', 'Asignación eliminada correctamente')
            ->with('icono', 'success');
    }

    private function validarDisponibilidad($gestorId, $cursoId, $excluirAsignacion = null)
    {
        $curso = Curso::findOrFail($cursoId);

        // Verificar si el gestor ya tiene cursos en el mismo horario
        $cursosSuperpuestos = GestorCurso::where('gestor_id', $gestorId)
            ->whereHas('curso', function ($query) use ($curso) {
                $query->where(function ($q) use ($curso) {
                    $q->whereBetween('fecha_inicio', [$curso->fecha_inicio, $curso->fecha_fin])
                        ->orWhereBetween('fecha_fin', [$curso->fecha_inicio, $curso->fecha_fin])
                        ->orWhere(function ($q) use ($curso) {
                            $q->where('fecha_inicio', '<=', $curso->fecha_inicio)
                                ->where('fecha_fin', '>=', $curso->fecha_fin);
                        });
                })
                    ->where(function ($q) use ($curso) {
                        $q->whereBetween('hora_inicio', [$curso->hora_inicio, $curso->hora_fin])
                            ->orWhereBetween('hora_fin', [$curso->hora_inicio, $curso->hora_fin])
                            ->orWhere(function ($q) use ($curso) {
                                $q->where('hora_inicio', '<=', $curso->hora_inicio)
                                    ->where('hora_fin', '>=', $curso->hora_fin);
                            });
                    });
            });

        if ($excluirAsignacion) {
            $cursosSuperpuestos->whereNotIn('id', [$excluirAsignacion->id]);
        }

        return $cursosSuperpuestos->doesntExist();
    }
}
