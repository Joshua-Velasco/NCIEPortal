<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Notification;

class PostListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // Determinar qué roles deben recibir la notificación
        $targetRoles = $event->forUsersOnly
            ? ['usuario']
            : ['admin', 'alumno', 'gestor', 'administrativo'];

        // Obtener usuarios con los roles especificados, excluyendo al creador
        User::whereHas('roles', function ($query) use ($targetRoles) {
            $query->whereIn('name', $targetRoles);
        })
            ->where('id', '!=', $event->post->user_id)
            ->each(function (User $user) use ($event) {
                Notification::send($user, new PostNotification($event->post));
            });
    }
}
