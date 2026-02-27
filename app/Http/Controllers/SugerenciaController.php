<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SugerenciaMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SugerenciaController extends Controller
{
    public function send(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ]);

            // Buscar al usuario por el correo electrónico
            $user = User::where('email', $validated['email'])->first();

            // Verificar si el usuario existe y si tiene el correo verificado
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se ha podido enviar el mensaje. Regístrate y verifica tu correo.'
                ], 403);
            }

            if (!$user->hasVerifiedEmail()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Verifica tu correo.'
                ], 403);
            }

            // Procesar el envío del correo
            Mail::to('sistemancie@gmail.com')->send(new SugerenciaMail($validated));

            return response()->json([
                'success' => true,
                'message' => 'Mensaje enviado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
