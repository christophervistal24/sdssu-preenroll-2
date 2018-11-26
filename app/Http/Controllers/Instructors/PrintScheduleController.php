<?php

namespace App\Http\Controllers\Instructors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instructor;
use Illuminate\Support\Facades\Auth;

class PrintScheduleController extends Controller
{

    public function index()
    {
    	$instructors = Instructor::where('id_number',Auth::user()->id_number)
                            ->with('schedules')
                            ->get();
    	$pdf = \App::make('dompdf.wrapper');
		$pdf->loadView('instructors.printforms.schedule',compact('instructors'));
		$pdf->setPaper('legal');
		return $pdf->stream();
    }
}
