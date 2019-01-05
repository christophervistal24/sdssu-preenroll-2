<?php

namespace App\Events;

use App\Student;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendStudentGrade
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $student_id_number , $student_model;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Student $student_model ,$student_id_number)
    {
        $this->student_id_number = $student_id_number;
        $this->student_model = $student_model;
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
