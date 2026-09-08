<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Horario;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $selectedAreaId = $request->input('area_id', $areas->first()->id ?? null);
        $proyectos = Proyecto::with(['gestores.horarios.area'])->orderByDesc('id')->get();

        return view('index', compact('areas', 'selectedAreaId', 'proyectos'));
    }

    public function cargar_datos_areas($id)
    {
        $area = Area::find($id);
        try {
            $horarios = Horario::with('gestor', 'area')
                ->where('area_id', $id)
                ->get()
                ->groupBy('gestor_id'); // Agrupar por gestor

            $html = view('cargar_datos_areas', compact('horarios', 'area'))->render();

            // Longitud explícita: evita la transferencia en trozos y que el navegador
            // se quede esperando el cierre de la respuesta.
            return response($html, 200)
                ->header('Content-Type', 'text/html; charset=UTF-8')
                ->header('Content-Length', (string) strlen($html))
                ->header('Cache-Control', 'no-store');
        } catch (\Exception $exception) {
            return response()->json(['mensaje' => 'Error'], 500);
        }
    }

    public function index2()
    {
        return view('index');
    }
}
