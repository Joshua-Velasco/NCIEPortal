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
        $user = auth()->user();
        $postNotifications = $user->unreadNotifications;
        $readNotifications = $user->readNotifications()->latest()->limit(30)->get();

        return view('post.notifications', compact('postNotifications', 'readNotifications'));
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
                'for_users_only' => 'nullable|boolean',
            ]);

            $data = $request->all();
            $data['user_id'] = Auth::id();

            $post = Post::create($data);

            if (!$post) {
                return back()->with('mensaje', 'No se ha podido crear la notificación')
                    ->with('icono', 'error');
            }

            // Disparamos el evento indicando si es solo para usuarios
            event(new PostEvent($post, $request->boolean('for_users_only')));

            return back()->with('mensaje', 'Aviso publicado')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            return back()->with('mensaje', 'No se ha podido crear la notificación: ' . $e->getMessage())
                ->with('icono', 'error');
        }
    }

    public function markNotification(Request $request)
    {
        $notifications = auth()->user()->unreadNotifications
            ->when($request->input('id'), function ($collection) use ($request) {
                return $collection->where('id', $request->input('id'));
            });
        $notifications->markAsRead();

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['ok' => true, 'unread' => auth()->user()->unreadNotifications()->count()]);
        }

        return back();
    }
}
