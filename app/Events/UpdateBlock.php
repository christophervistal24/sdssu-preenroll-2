<?php

namespace App\Events;

use App\Block;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateBlock
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $block;
    public $block_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Block $block , $block_id)
    {
        $this->block = $block;
        $this->block_id = $block_id;
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
