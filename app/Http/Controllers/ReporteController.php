<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Gestor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index()
    {
        // El middleware 'can' ya validó el permiso, podemos asumir que es gestor
        $gestor = Auth::user()->gestor;

        // Forzar la carga de la relación por si acaso
        if (!$gestor) {
            abort(403, 'No estás registrado como gestor');
        }

        // Obtener cursos incluso si están vacíos
        $cursos = $gestor->cursos()
            ->with(['alumnos' => function ($query) {
                $query->select('users.id', 'name', 'email')
                    ->withPivot('created_at');
            }])
            ->get();

        // Si no hay cursos, devolvemos una colección vacía
        return view('reportes.index', [
            'cursos' => $cursos,
            'mensaje' => $cursos->isEmpty() ? 'No tienes cursos asignados' : null
        ]);
    }

    public function cursosAsignados()
    {
        $gestor = Auth::user()->gestor;

        if (!$gestor) {
            return view('reportes.cursos-asignados', [
                'cursos' => collect(),
                'mensaje' => 'No estás registrado como gestor.'
            ]);
        }

        $cursos = $gestor->cursos()->get(); // Solo datos básicos del curso

        return view('reportes.cursos-asignados', [
            'cursos' => $cursos,
            'mensaje' => $cursos->isEmpty() ? 'No tienes cursos asignados.' : null
        ]);
    }
}
