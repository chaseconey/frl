<?php

namespace App\Events;

use App\Models\Division;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DivisionCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Division $division;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Division $division)
    {
        $this->division = $division;
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
