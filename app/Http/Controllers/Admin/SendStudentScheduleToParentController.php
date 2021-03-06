<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
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

        $config        = Configuration::getDefaultConfiguration();
        $config->setSSLVerification(false); // add this line
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU1MDcxMTg1NiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY1MDk1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.sdc7kmj6DhttkJLBNmhzMc8BWZFL97w5szMX-Jh_r1I');

        $apiClient     = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $request->parent_mobile_number,
            'message'     => $request->student_schedules,
            'deviceId'    => 109583
        ]);
             $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest1,
            ]);

         if ($sendMessages) {
            return redirect()->back()->with('status','Successfully send a message to ' . $request->parent_mobile_number);
        }
    }
}
