<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Horario;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $selectedAreaId = $request->input('area_id', $areas->first()->id ?? null);
        return view('index', compact('areas', 'selectedAreaId'));
    }

    public function cargar_datos_areas($id)
    {
        $area = Area::find($id);
        try {
            $horarios = Horario::with('gestor', 'area')
                ->where('area_id', $id)
                ->get()
                ->groupBy('gestor_id'); // Agrupar por gestor

            return view('cargar_datos_areas', compact('horarios', 'area'));
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error'], 500);
        }
    }

    public function index2()
    {
        return view('index');
    }
}
