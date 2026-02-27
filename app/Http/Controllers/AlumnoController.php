<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $alumnos = Alumno::with('user')->get();
        return view('admin.alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.alumnos.create');
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
            'numero_control' => 'required|max:8|unique:alumnos',
            'carrera' => 'required',
            'semestre' => 'required',
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


        $alumno = new Alumno();
        $alumno->user_id = $usuario->id;
        $alumno->nombres = $request->nombres;
        $alumno->apellidos = $request->apellidos;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->celular = $request->celular;
        $alumno->numero_control = $request->numero_control;
        $alumno->carrera = $request->carrera;
        $alumno->semestre = $request->semestre;
        $alumno->save();

        $usuario->assignRole('alumno');

        return redirect()->route('admin.alumnos.index')
            ->with('mensaje', 'Se registro al alumno de la manera correcta')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alumno = Alumno::with('user')->findOrFail($id);
        return view('admin.alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alumno = Alumno::with('user')->findOrFail($id);
        return view('admin.alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|max:10|',
            'numero_control' => 'required|max:8|unique:alumnos,numero_control,' . $alumno->id,
            'carrera' => 'required',
            'semestre' => 'required',
            'email' => 'required|max:250|unique:users,email,' . $alumno->user->id,
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

        $alumno->nombres = $request->nombres;
        $alumno->apellidos = $request->apellidos;
        $alumno->fecha_nacimiento = $request->fecha_nacimiento;
        $alumno->celular = $request->celular;
        $alumno->numero_control = $request->numero_control;
        $alumno->carrera = $request->carrera;
        $alumno->semestre = $request->semestre;
        $alumno->save();

        $usuario = User::find($alumno->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.alumnos.index')
            ->with('mensaje', 'Se actualizo al alumno de la manera correcta')
            ->with('icono', 'success');
    }

    public function confirmDelete($id)
    {
        $alumno = Alumno::with('user')->findOrFail($id);
        return view('admin.alumnos.delete', compact('alumno'));
    }

    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        $user = $alumno->user;
        $user->delete();

        $alumno->delete();

        return redirect()->route('admin.alumnos.index')
            ->with('mensaje', 'Se elimino al alumno de la manera correcta')
            ->with('icono', 'success');
    }
}
