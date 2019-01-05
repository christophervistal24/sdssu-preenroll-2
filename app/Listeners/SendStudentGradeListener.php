<?php

namespace App\Listeners;

use App\Events\SendStudentGrade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendStudentGradeListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendStudentGrade $event)
    {
        $event->student_model->sendSMS($event->student_id_number);
    }
}
