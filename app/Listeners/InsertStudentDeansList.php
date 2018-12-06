<?php

namespace App\Listeners;

use App\Events\DeansList as StudentDeansList;
use App\Student;
use App\Subject;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InsertStudentDeansList
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
    public function handle(StudentDeansList $event)
    {
         $event->deans_list //find all students that qualified for deanslist
             ->insertQualifiedForDeansLister(new Student , new Subject);
    }
}
