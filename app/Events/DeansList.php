<?php

namespace App\Events;

use App\DeansList as DeansListModel;
use App\Semester;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeansList
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $deans_list , $semester;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(DeansListModel $deans_list , Semester $semester)
    {
        $this->deans_list = $deans_list;
        $this->semester = $semester;
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
