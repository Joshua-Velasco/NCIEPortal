<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::all();
        return view('admin.proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;

        if ($request->hasFile('fotos')) {
            $fotoPath = $request->file('fotos');
            $nombreArchivo = $fotoPath->hashName();
            $rutaDestino = public_path('uploads/fotos');
            $fotoPath->move($rutaDestino, $nombreArchivo);
            $proyecto->fotos = 'uploads/fotos/' . $nombreArchivo;
        }

        $proyecto->save();

        return redirect()->route('admin.proyectos.index')
            ->with('mensaje', 'Se registró el proyecto correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        return view('admin.proyectos.show', compact('proyectos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        return view('admin.proyectos.edit', compact('proyectos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fotos' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Actualizar campos básicos
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;

        // Manejo de la imagen
        if ($request->has('eliminar_imagen')) {
            // Eliminar imagen actual si existe
            if ($proyecto->fotos && file_exists(public_path($proyecto->fotos))) {
                unlink(public_path($proyecto->fotos));
            }
            $proyecto->fotos = null;
        } elseif ($request->hasFile('fotos')) {
            // Eliminar foto anterior si existe
            if ($proyecto->fotos && file_exists(public_path($proyecto->fotos))) {
                unlink(public_path($proyecto->fotos));
            }

            // Guardar nueva imagen
            $fotoPath = $request->file('fotos');
            $nombreArchivo = $fotoPath->hashName();
            $rutaDestino = public_path('uploads/fotos');
            $fotoPath->move($rutaDestino, $nombreArchivo);
            $proyecto->fotos = 'uploads/fotos/' . $nombreArchivo;
        }

        $proyecto->save();

        return redirect()->route('admin.proyectos.index')
            ->with('mensaje', 'Se actualizó el proyecto correctamente')
            ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
        $proyectos = Proyecto::findOrFail($id);
        return view('admin.proyectos.delete', compact('proyectos'));
    }

    public function destroy($id)
    {
        $proyectos = Proyecto::findOrFail($id);

        if ($proyectos->fotos && file_exists(public_path($proyectos->fotos))) {
            unlink(public_path($proyectos->fotos));
        }

        $proyectos->delete();

        return redirect()->route('admin.proyectos.index')
            ->with('mensaje', 'Se elimino el proyecto correctamente')
            ->with('icono', 'success');
    }
}
