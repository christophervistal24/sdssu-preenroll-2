<?php
namespace App\Repository;

use App\Schedule;
use Exception;

class ScheduleRepository
{
    private $schedule;

    public function __construct(Schedule $sched)
    {
        $this->schedule = $sched;
    }

    public function isAlreadyExists($request)
    {
        $subject = array_values($request->subject)[0];

        //change the value of schedule subject to id
        $request->subject = $this->schedule::getIdOfSubject($subject);
        if ($this->schedule->check($request->except('_token'))) {
             throw new Exception('This schedule is already exists');
        }
    }

    public function checkBetweenOtherSchedule($request)
    {
        dd($this->schedule->checkBetween($request));
        // if ($this->schedule->checkBetween($request)->isNotEmpty()) {
        //     throw new Exception('Sorry but this schedule is conclict to others.');
        //  }
    }

}
?>