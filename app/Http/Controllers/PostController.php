<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        $postNotifications = auth()->user()->unreadNotifications;
        return view('post.notifications', compact('postNotifications'));
    }


    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'for_users_only' => 'sometimes|boolean' // Nuevo campo
            ]);

            $data = $request->all();
            $data['user_id'] = Auth::id();

            $post = Post::create($data);

            if (!$post) {
                return back()->with('mensaje', 'No se ha podido crear la notificación')
                    ->with('icono', 'error');
            }

            // Disparamos el evento indicando si es solo para usuarios
            event(new PostEvent($post, $request->has('for_users_only')));

            return back()->with('mensaje', 'Notificación creada correctamente')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return back()->with('mensaje', 'No se ha podido crear la notificación: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })->markAsRead();
        return response()->noContent();
    }
}
