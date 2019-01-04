<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class SendStudentScheduleToParentController extends Controller
{
    public function __construct()
    {
    }

    public function create(Request $request , Student $student)
    {
        $student_schedules = $student->schedules;
        return view('admins.send-forms.sendscheduletoparent',
            compact('student_schedules','student'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'parent_mobile_number' => 'required',
            'student_schedules' => 'required',
        ]);
        //send logic here
        dd('Please write the send sms logic');
    }
}
