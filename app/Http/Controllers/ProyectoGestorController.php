<?php

namespace App\Http\Controllers;

use App\Models\Gestor;
use App\Models\GestorProyecto;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoGestorController extends Controller
{
    public function index()
    {
        $proyectosConGestores = Proyecto::with(['gestores' => function ($query) {
            $query->withPivot('id');
        }])->get();

        return view('admin.proyecto_gestores.index', compact('proyectosConGestores'));
    }
    public function create()
    {
        $gestores = Gestor::all();
        $proyectos = Proyecto::all();
        return view('admin.proyecto_gestores.create', compact('gestores', 'proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gestor_id' => 'required|exists:gestores,id',
            'proyecto_id' => 'required|exists:proyectos,id'
        ]);

        $gestor = Gestor::findOrFail($request->gestor_id);

        // Verificar si ya tiene asignado este proyecto
        if ($gestor->proyectos()->where('proyecto_id', $request->proyecto_id)->exists()) {
            return back()
                ->withInput()
                ->with([
                    'mensaje' => 'Este gestor ya está asignado a este proyecto',
                    'icono' => 'error' // o 'warning' según tu sistema de iconos
                ]);
        }

        // Asignar proyecto al gestor
        $gestor->proyectos()->attach($request->proyecto_id);

        return redirect()->route('admin.proyecto_gestores.index')
            ->with('mensaje', 'Asignación actualizada correctamente')
            ->with('icono', 'success');
    }

    public function edit($id)
    {
        $asignacion = GestorProyecto::with(['gestor', 'proyecto'])->findOrFail($id);
        $gestores = Gestor::all();
        $proyectos = Proyecto::all();

        return view('admin.proyecto_gestores.edit', compact('asignacion', 'gestores', 'proyectos'));
    }

    public function update(Request $request, $id)
    {
        $asignacion = GestorProyecto::findOrFail($id);

        $request->validate([
            'gestor_id' => 'required|exists:gestores,id',
            'proyecto_id' => 'required|exists:proyectos,id|unique:gestor_proyecto,proyecto_id,' . $id . ',id,gestor_id,' . $request->gestor_id
        ], [
            'proyecto_id.unique' => 'Este gestor ya está asignado a este proyecto'
        ]);

        $asignacion->update([
            'gestor_id' => $request->gestor_id,
            'proyecto_id' => $request->proyecto_id
        ]);

        return redirect()->route('admin.proyecto_gestores.index')
            ->with('mensaje', 'Asignación actualizada correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $asignacion = GestorProyecto::with(['gestor', 'proyecto'])->findOrFail($id);
        return view('admin.proyecto_gestores.delete', compact('asignacion'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asignacion = GestorProyecto::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('admin.proyecto_gestores.index')
            ->with('mensaje', 'Asignación eliminada correctamente')
            ->with('icono', 'success');
    }

    public function misProyectos()
    {
        // Obtener el gestor autenticado
        $gestor = Auth::user()->gestor;

        // Obtener proyectos asignados al gestor con paginación
        $proyectos = $gestor->proyectos()->paginate(6);

        return view('reportes.mis_proyectos', compact('proyectos'));
    }
}
