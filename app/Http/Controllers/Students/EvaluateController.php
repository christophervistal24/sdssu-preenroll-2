<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Semester;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluateController extends Controller
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index()
    {
        $grades = [];
        $student = $this->student
                        ->find(Auth::user()->id_number);
        $s_grades = $this->student
                         ->with(['grades' => function ($query) {
                                $query->orderBy('created_at');
                         }])->find($student->id_number);
        array_walk_recursive($s_grades->grades, function ($value , $key) use(&$grades) {
        $grades[$value->subject->year.'_year_'.$value->subject->semester.'_semester_subjects']
            [] = $value;
        });
        return view('admins.studentevaluate',compact(['student','grades']));
    }
}
