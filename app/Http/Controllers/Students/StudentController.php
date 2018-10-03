<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
	public function preenrol()
	{
		return view('students.preenrol');
	}

	public function evaluate()
	{
		return view('students.evaluate');
	}

	public function schedule()
	{
		return view('students.schedule');
	}

	public function sendsms()
	{
		return view('students.sendsms');
	}

	public function login()
    {
        return view('students.login');
    }
}
