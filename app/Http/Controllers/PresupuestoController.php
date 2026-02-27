<?php

namespace App\Http\Controllers;

use App\Models\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presupuestos = Presupuesto::all();
        return view('admin.presupuestos.index', compact('presupuestos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.presupuestos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'motivo' => 'required',
            'monto' => 'required',
            'fecha' => 'required'
        ]);

        Presupuesto::create($request->all());

        return redirect()->route('admin.presupuestos.index')
            ->with('mensaje', 'Se registro el presupuesto de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('admin.presupuestos.edit', compact('presupuesto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'motivo' => 'required',
            'monto' => 'required',
            'fecha' => 'required'
        ]);

        $presupuesto = Presupuesto::find($id);
        $presupuesto->update($request->all());

        return redirect()->route('admin.presupuestos.index')
            ->with('mensaje', 'Se actualizo el presupuesto de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id)
    {
        $presupuesto = Presupuesto::findOrFail($id);
        return view('admin.presupuestos.delete', compact('presupuesto'));
    }

    public function destroy($id)
    {
        $presupuesto = Presupuesto::find($id);
        $presupuesto->delete();

        return redirect()->route('admin.presupuestos.index')
            ->with('mensaje', 'Se elimino el presupuesto de la manera correcta')
            ->with('icono', 'success');
    }
}
