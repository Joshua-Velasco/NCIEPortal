<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoProyecto;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = AlumnoProyecto::with(['alumno', 'proyecto'])->get();
        return view('admin.alumno_proyecto.index', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alumnos = Alumno::all();
        $proyectos = Proyecto::all();
        return view('admin.alumno_proyecto.create', compact('alumnos', 'proyectos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'tipo' => 'required|in:residencias,servicio_social,propio',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio'
        ]);

        // Verificar si ya existe la asignación
        if (AlumnoProyecto::where('alumno_id', $request->alumno_id)
            ->where('proyecto_id', $request->proyecto_id)
            ->exists()
        ) {
            return back()
                ->withInput()
                ->with([
                    'mensaje' => 'Este alumno ya está asignado a este proyecto',
                    'icono' => 'error'
                ]);
        }

        AlumnoProyecto::create($request->all());

        return redirect()->route('admin.alumno_proyecto.index')
            ->with('mensaje', 'Asignación creada correctamente')
            ->with('icono', 'success');
    }


    public function edit(string $id)
    {
        $asignacion = AlumnoProyecto::with(['alumno', 'proyecto'])->findOrFail($id);
        $alumnos = Alumno::all();
        $proyectos = Proyecto::all();

        return view('admin.alumno_proyecto.edit', compact('asignacion', 'alumnos', 'proyectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $asignacion = AlumnoProyecto::findOrFail($id);

        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'tipo' => 'required|in:residencias,servicio_social,propio',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio'
        ]);

        // Verificar si la nueva combinación ya existe (excepto para el registro actual)
        if (AlumnoProyecto::where('alumno_id', $request->alumno_id)
            ->where('proyecto_id', $request->proyecto_id)
            ->where('id', '!=', $id)
            ->exists()
        ) {
            return back()
                ->withInput()
                ->with([
                    'mensaje' => 'Este alumno ya está asignado a este proyecto',
                    'icono' => 'error'
                ]);
        }

        $asignacion->update($request->all());

        return redirect()->route('admin.alumno_proyecto.index')
            ->with('mensaje', 'Asignación actualizada correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $asignacion = AlumnoProyecto::with(['alumno', 'proyecto'])->findOrFail($id);
        return view('admin.alumno_proyecto.delete', compact('asignacion'));
    }

    public function destroy($id)
    {
        $asignacion = AlumnoProyecto::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('admin.alumno_proyecto.index')
            ->with('mensaje', 'Asignación eliminada correctamente')
            ->with('icono', 'success');
    }

    public function misProyectos()
    {
        // Obtener el ID del alumno autenticado
        $alumnoId = auth()->user()->alumno->id ?? null;

        if (!$alumnoId) {
            return view('inscripciones.mis_proyectos', [
                'proyectos' => collect(),
                'error' => 'No se encontró tu registro de alumno'
            ]);
        }

        // Obtener las asignaciones con la relación al proyecto
        $proyectos = AlumnoProyecto::with('proyecto')
            ->where('alumno_id', $alumnoId)
            ->get();

        // Depuración (opcional)
        // logger($proyectos->toArray());

        return view('inscripciones.mis_proyectos', compact('proyectos'));
    }
}
