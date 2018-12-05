<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Semester;
use App\Student;
use App\Subject;
use App\Traits\DeansListUtils;
use Illuminate\Http\Request;

class DeansListController extends Controller
{
    use DeansListUtils;

    private $student , $subject;

    public function __construct(Student $student , Subject $subject)
    {
        $this->student = $student;
        $this->subject = $subject;
    }

    public function index()
    {
        $list = DeansList::with('student')
                            ->get();
        return view('admins.list-of-deanslist',compact('list'));
    }
}
