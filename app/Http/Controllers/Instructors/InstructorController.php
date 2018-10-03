<?php

namespace App\Http\Controllers\Instructors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstructorController extends Controller
{
    public function schedule()
    {
    	return view('instructors.schedule');
    }

    public function sendsms()
    {
    	return view('instructors.sendsms');
    }

    public function login()
    {
    	return view('instructors.login');
    }
}
