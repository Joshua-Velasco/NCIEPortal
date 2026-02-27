<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        Area::create($request->all());

        return redirect()->route('admin.areas.index')
            ->with('mensaje', 'Se registro el área de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.areas.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $area = Area::find($id);
        $area->update($request->all());

        return redirect()->route('admin.areas.index')
            ->with('mensaje', 'Se actualizo el área de la manera correcta')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $area = Area::findOrFail($id);
        return view('admin.areas.delete', compact('area'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area = Area::find($id);
        $area->delete();

        return redirect()->route('admin.areas.index')
            ->with('mensaje', 'Se elimino el área de la manera correcta')
            ->with('icono', 'success');
    }
}
