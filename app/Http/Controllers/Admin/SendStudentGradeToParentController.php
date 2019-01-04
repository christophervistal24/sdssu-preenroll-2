<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;


class SendStudentGradeToParentController extends Controller
{
    public function create(Student $student)
    {
        $s_grades = Student::with(['grades','schedules' => function ($query) {
                $query->orderBy('created_at');
        }])->find($student->id_number);
        $grades = [];
        array_walk_recursive($s_grades->grades, function ($value , $key) use(&$grades) {
            $grades[
                $value->subject->year.'_year_'.$value->subject->semester.'_semester_subjects'
            ][] = $value;
        });

        return view('admins.send-forms.sendgradetoparents',compact('student','grades'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'parent_mobile_number' => 'required',
            'grades'     => 'required',
        ]);
        dd('send logic here');
    }
}
