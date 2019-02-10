<?php

namespace App\Http\Controllers\Instructors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\Semester;
use Illuminate\Support\Facades\Auth;

class PrintScheduleController extends Controller
{

    public function index($is_schedule = null)
    {
        $current_semester = Semester::where('current',1)->first();
        //checking if the route request previous or new schedules\
        //of the instructor
        $is_schedule = ($is_schedule == 0) ? 'delete' : 'active'; 

        //query to database
    	$instructors = Instructor::where('id_number',Auth::user()->id_number)
                            ->with(['schedules' => function ($q) use ($is_schedule) {
                               $q->where('status','!=',$is_schedule); 
                            }])->get();
                            
        //load the pdf to the view
    	$pdf = \App::make('dompdf.wrapper');
		$pdf->loadView('instructors.printforms.schedule',compact('instructors','current_semester'));
		$pdf->setPaper('legal');
		return $pdf->stream();
    }
}
