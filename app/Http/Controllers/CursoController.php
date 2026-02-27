<?php

namespace App\Http\Controllers;

use App\Models\Administrativo;
use App\Models\Curso;
use App\Models\Gestor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = Curso::all();
        return view('admin.cursos.index', compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cursos.create');
    }


    public function getCursosForCalendar()
    {
        $cursos = Curso::has('gestores')->get();
        $events = [];

        $colors = ['#FF5733', '#33FF57', '#3357FF', '#F333FF', '#33FFF3', '#FF33A8', '#A833FF'];

        foreach ($cursos as $index => $curso) {
            $colorIndex = $index % count($colors);

            $events[] = [
                'title' => $curso->nombre . ' (' . $curso->hora_inicio . ' - ' . $curso->hora_fin . ')',
                'start' => $curso->fecha_inicio,
                'end' => $curso->fecha_fin ? date('Y-m-d', strtotime($curso->fecha_fin . ' +1 day')) : null,
                'color' => $colors[$colorIndex],
                'extendedProps' => [
                    'lugar' => $curso->lugar,
                    'modalidad' => $curso->modalidad,
                    'requisitos' => $curso->requisitos,
                    'descripcion' => $curso->descripcion

                ]
            ];
        }

        return response()->json($events);
    }

    public function store(Request $request)
    {

        // Validación de los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(now())) {
                        $fail('La fecha de inicio no puede ser en el pasado.');
                    }
                }
            ],
            'fecha_fin' => [
                'required',
                'date',
                'after:fecha_inicio',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->fecha_inicio)) {
                        $fail('La fecha de fin no puede ser anterior a la fecha de inicio.');
                    }
                }
            ],
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'lugar' => 'required|string|max:255',
            'requisitos' => 'nullable|string',
            'modalidad' => 'required|in:presencial,en_linea',
            'descripcion' => 'nullable|string'
        ]);


        // Creación del nuevo curso
        $curso = Curso::create($request->all());
        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Se registro el curso de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cursos = Curso::findOrFail($id);
        return view('admin.cursos.show', compact('cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cursos = Curso::findOrFail($id);
        return view('admin.cursos.edit', compact('cursos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario (similar a store)
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(now())) {
                        $fail('La fecha de inicio no puede ser en el pasado.');
                    }
                }
            ],
            'fecha_fin' => [
                'required',
                'date',
                'after:fecha_inicio',
                function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->fecha_inicio)) {
                        $fail('La fecha de fin no puede ser anterior a la fecha de inicio.');
                    }
                }
            ],
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'lugar' => 'required|string|max:255',
            'requisitos' => 'nullable|string',
            'modalidad' => 'required|in:presencial,en_linea',
            'descripcion' => 'nullable|string'
        ]);

        // Buscar el curso a actualizar
        $curso = Curso::findOrFail($id);

        // Actualizar los datos del curso
        $curso->update([
            'nombre' => $request->nombre,
            'feha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'lugar' => $request->lugar,
            'requisitos' => $request->requisitos,
            'modalidad' => $request->modalidad,
            'descripcion' => $request->descripcion
        ]);

        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Se actualizo el curso de la manera correcta')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $cursos = Curso::findOrFail($id);
        return view('admin.cursos.delete', compact('cursos'));
    }

    public function destroy($id)
    {
        Curso::destroy($id);
        return redirect()->route('admin.cursos.index')
            ->with('mensaje', 'Se elimino el curso de la manera correcta')
            ->with('icono', 'success');
    }
}
