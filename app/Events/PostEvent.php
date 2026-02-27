<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostEvent
{
    public $post;
    public $forUsersOnly;
    use Dispatchable, InteractsWithSockets, SerializesModels;




    /**
     * Create a new event instance.
     */
    public function __construct($post, $forUsersOnly = false)
    {
        $this->post = $post;
        $this->forUsersOnly = $forUsersOnly;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
