<?php

namespace App\Events\Models\User;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userName;
    public $userEmail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $userName, String $userEmail)
    {
        $this->userName=$userName;
        $this->userEmail = $userEmail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
