<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LiveFeed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lane;
    public $champion;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lane, $champion)
    {
        //
        $this->lane = $lane;
        $this->champion = $champion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('probuilds');
    }

    public function broadcastAs()
    {
        $name = 'livefeed.' . $this->lane;
        if (!empty($this->champion)) {
            $name = 'livefeed.' . $this->lane . "." . $this->champion;
        }
        return $name;
    }
}
