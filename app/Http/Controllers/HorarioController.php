<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Gestor;
use App\Models\Horario;
use Exception;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $areas = Area::all();
        $horarios = Horario::with('gestor', 'area')->get();
        $gestores = Gestor::with('horarios')->get(); // Obtener todos los gestores con sus horarios
        $selectedAreaId = $request->input('area_id', $areas->first()->id ?? null);

        return view('admin.horarios.index', compact('horarios', 'gestores', 'areas', 'selectedAreaId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gestores = Gestor::all();
        $areas = Area::all();
        return view('admin.horarios.create', compact('gestores', 'areas'));
    }

    public function cargar_datos_areas($id)
    {
        try {
            $horarios = Horario::with('gestor', 'area')
                ->where('area_id', $id)
                ->get()
                ->groupBy('gestor_id'); // Agrupar por gestor

            return view('admin.horarios.cargar_datos_areas', compact('horarios'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gestor_id' => 'required',
            'area_id' => 'required',
            'dia' => 'required|array|min:1',
            'dia.*' => 'in:LUNES,MARTES,MIERCOLES,JUEVES,VIERNES',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        // Validar si el gestor ya tiene un horario
        $horarioExistente = Horario::where('gestor_id', $request->gestor_id)->first();

        if ($horarioExistente) {
            return redirect()->route('admin.horarios.create')
                ->with('mensaje', 'El gestor ya tiene un horario asignado')
                ->with('icono', 'error');
        }


        // Combina los días seleccionados (ej: "LUNES,JUEVES")
        $diasSeleccionados = implode(',', $request->dia);

        Horario::create([
            'gestor_id' => $request->gestor_id,
            'area_id' => $request->area_id,
            'dia' => $diasSeleccionados,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('admin.horarios.index', ['area_id' => $request->area_id])
            ->with('mensaje', 'Se registró el horario correctamente')
            ->with('icono', 'success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $horario = Horario::find($id);
        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $gestores = Gestor::all();
        $areas = Area::all();

        // Convertir los días almacenados (ej: "LUNES,JUEVES") a array para el formulario
        $diasSeleccionados = explode(',', $horario->dia);

        return view('admin.horarios.edit', compact('horario', 'gestores', 'areas', 'diasSeleccionados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $horario = Horario::find($id);

        $request->validate([
            'gestor_id' => 'required',
            'area_id' => 'required',
            'dia' => 'required|array|min:1',
            'dia.*' => 'in:LUNES,MARTES,MIERCOLES,JUEVES,VIERNES',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        $horario = Horario::findOrFail($id);

        // Combina los días seleccionados (ej: "LUNES,JUEVES")
        $diasSeleccionados = implode(',', $request->dia);

        $horario->update([
            'gestor_id' => $request->gestor_id,
            'area_id' => $request->area_id,
            'dia' => $diasSeleccionados,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Se actualizo el horario de la manera correcta')
            ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
        $horario = Horario::findOrFail($id);
        return view('admin.horarios.delete', compact('horario'));
    }

    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Se elimino el horario correctamente')
            ->with('icono', 'success');
    }
}
