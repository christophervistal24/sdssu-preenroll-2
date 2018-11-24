<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluateController extends Controller
{
    public function index()
    {
    	$student = Student::find(Auth::user()->id_number);
		return view('students.evaluate',compact('student'));
    }
}
