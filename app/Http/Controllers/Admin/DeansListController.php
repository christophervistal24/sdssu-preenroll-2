<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;

class DeansListController extends Controller
{
    public function index()
    {
    	$s = Student::with('grades')->get();
		foreach ($s as $value) {
			if (!$value->grades->isEmpty()) {
				echo $value->id_number . "<br>";
			}
		}
     	//display all students who are qualified for deans list
    }
}
