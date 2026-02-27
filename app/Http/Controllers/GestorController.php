<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Gestor;
use Illuminate\Http\Request;

class GestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestores = Gestor::with('user')->get();
        return view('admin.gestores.index', compact('gestores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gestores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|max:10|',
            'carrera' => 'required',
            'grado_academico' => 'required',
            'email' => 'required|max:250|unique:users',
            'password' => [
                'required',
                'max:250',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula y un número.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]);
        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $gestor = new Gestor();
        $gestor->user_id = $usuario->id;
        $gestor->nombres = $request->nombres;
        $gestor->apellidos = $request->apellidos;
        $gestor->fecha_nacimiento = $request->fecha_nacimiento;
        $gestor->celular = $request->celular;
        $gestor->carrera = $request->carrera;
        $gestor->grado_academico = $request->grado_academico;
        $gestor->save();

        $usuario->assignRole('gestor');

        return redirect()->route('admin.gestores.index')
            ->with('mensaje', 'Se registro al gestor de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gestor = Gestor::findOrFail($id);
        return view('admin.gestores.show', compact('gestor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gestor = Gestor::findOrFail($id);
        return view('admin.gestores.edit', compact('gestor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gestor = Gestor::find($id);


        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|max:10|',
            'carrera' => 'required',
            'grado_academico' => 'required',
            'email' => 'required|max:250|unique:users,email,' . $gestor->user->id,
            'password' => [
                'nullable',
                'max:250',
                'confirmed',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*\d).+$/'
            ],
        ], [
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula y un número.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]);

        $gestor->nombres = $request->nombres;
        $gestor->apellidos = $request->apellidos;
        $gestor->fecha_nacimiento = $request->fecha_nacimiento;
        $gestor->celular = $request->celular;
        $gestor->carrera = $request->carrera;
        $gestor->grado_academico = $request->grado_academico;
        $gestor->save();


        $usuario = User::find($gestor->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.gestores.index')
            ->with('mensaje', 'Se actualizo al gestor de la manera correcta')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $gestor = Gestor::with('user')->findOrFail($id);
        return view('admin.gestores.delete', compact('gestor'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gestor = Gestor::find($id);

        //Eliminar al usuario asociado
        $user = $gestor->user;
        $user->delete();

        //Eliminar al gestor
        $gestor->delete();

        return redirect()->route('admin.gestores.index')
            ->with('mensaje', 'Se elimino al gestor de la manera correcta')
            ->with('icono', 'success');
    }
}
