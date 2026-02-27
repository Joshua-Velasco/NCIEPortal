<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Administrativo;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrativos = Administrativo::with('user')->get();
        return view('admin.administracion.index', compact('administrativos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.administracion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
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

        $administrativo = new Administrativo();
        $administrativo->user_id = $usuario->id;
        $administrativo->nombres = $request->nombres;
        $administrativo->apellidos = $request->apellidos;
        $administrativo->telefono = $request->telefono;
        $administrativo->carrera = $request->carrera;
        $administrativo->grado_academico = $request->grado_academico;
        $administrativo->save();

        $usuario->assignRole('administrativo');

        return redirect()->route('admin.administracion.index')
            ->with('mensaje', 'Se registro al administrativo de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $administrativo = Administrativo::with('user')->findOrFail($id);
        return view('admin.administracion.show', compact('administrativo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $administrativo = Administrativo::with('user')->findOrFail($id);
        return view('admin.administracion.edit', compact('administrativo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $administrativo = Administrativo::find($id);


        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'carrera' => 'required',
            'grado_academico' => 'required',
            'email' => 'required|max:250|unique:users,email,' . $administrativo->user->id,
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

        $administrativo->nombres = $request->nombres;
        $administrativo->apellidos = $request->apellidos;
        $administrativo->telefono = $request->telefono;
        $administrativo->carrera = $request->carrera;
        $administrativo->grado_academico = $request->grado_academico;
        $administrativo->save();


        $usuario = User::find($administrativo->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.administracion.index')
            ->with('mensaje', 'Se actualizo al administrativo de la manera correcta')
            ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
        $administrativo = Administrativo::with('user')->findOrFail($id);
        return view('admin.administracion.delete', compact('administrativo'));
    }


    public function destroy($id)
    {
        $administrativo = Administrativo::find($id);

        //Eliminar al usuario asociado
        $user = $administrativo->user;
        $user->delete();

        //Eliminar al administrativo
        $administrativo->delete();

        return redirect()->route('admin.administracion.index')
            ->with('mensaje', 'Se elimino al administrativo de la manera correcta')
            ->with('icono', 'success');
    }
}
