<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeansList;
use App\Semester;

class DeansListPrintController extends Controller
{
	public function __construct(DeansList $deans_list)
	{
		$this->deans_list = $deans_list;
	}

    public function print()
    {
    	$current_semester = Semester::where('current',1)->get();
    	$list = $this->deans_list
                     ->with('student')
                     ->get();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('admins.printforms.deanslist',compact('list','current_semester'));
        $pdf->setPaper('legal');
        return $pdf->stream();
    }
}
