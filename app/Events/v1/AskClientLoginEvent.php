<?php

namespace App\Events\v1;

use App\Http\Resources\v1\CurrentUserResource;
use App\Http\Resources\v1\UserResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AskClientLoginEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    /**
     * Create a new event instance.
     */
    public function __construct($id)
    {
        $this->dontBroadcastToCurrentUser();
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('ask-login-client-channel.' . $this->id),
        ];
    }

    public function broadcastAs()
    {
        return 'ask-login-client-event';
    }
}
