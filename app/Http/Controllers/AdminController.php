<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Area;
use App\Models\Administrativo;
use App\Models\AlumnoProyecto;
use App\Models\Curso;
use App\Models\Gestor;
use App\Models\GestorCurso;
use App\Models\GestorProyecto;
use App\Models\Horario;
use App\Models\Presupuesto;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $total_usuarios = User::count();
        $total_administrativos = Administrativo::count();
        $total_alumnos = Alumno::count();
        $total_areas = Area::count();
        $total_gestores = Gestor::count();
        $total_horarios = Horario::count();
        $total_cursos = Curso::count();
        $total_proyectos = Proyecto::count();
        $total_aignaciones = GestorCurso::count();
        $total_gestores_proyectos = GestorProyecto::count();
        $total_alumnos_proyectos = AlumnoProyecto::count();
        $total_presupuestos = Presupuesto::count();


        $areas = Area::all();
        $selectedAreaId = $request->input('area_id', $areas->first()->id ?? null);


        return view('admin.index', compact(
            'total_usuarios',
            'total_administrativos',
            'total_alumnos',
            'total_areas',
            'total_gestores',
            'total_horarios',
            'areas',
            'selectedAreaId',
            'total_cursos',
            'total_proyectos',
            'total_aignaciones',
            'total_gestores_proyectos',
            'total_alumnos_proyectos',
            'total_presupuestos'
        ));
    }
}
