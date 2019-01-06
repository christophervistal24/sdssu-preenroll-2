<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class DeansListController extends Controller
{
    protected $deans_list;
    private $students = [];
    public function __construct(DeansList $deans_list)
    {
        $this->deans_list = $deans_list;
        $this->students['count_deans_lister'] = $this->deans_list->count();
    }

    public function index()
    {
        $list = $this->deans_list
                     ->with('student')
                     ->get();
        return view('admins.list-of-deanslist',compact('list'));
    }

    public function create(Student $student)
    {
        return view('admins.send-forms.senddeanslist',compact('student'));
    }

    public function sendSMS(Request $request)
    {
       $this->validate($request,[
        'student_mobile_number' => 'required',
        'message' => 'required',
       ]);
       //send logic here
       $config        = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0NjY5MTQ1MiwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY1MDk1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.M79KNlmuRatpcUktQYSeKxRmckX3QHwPdksYfPc7nDI');
        $apiClient     = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $request->student_mobile_number,
            'message' => $request->message,
            'deviceId' => 107650
        ]);
        $sendMessages = $messageClient->sendMessages([$sendMessageRequest1]);
         if ($sendMessages) {
            return redirect()->back()->with('status','Successfully send a message to ' . $request->student_mobile_number);
        }

    }

    //checking if there's a new student qualified for deans list
    //this will call every interval see at deanlist.js
    public function checkDeansList($last_record)
    {
        if ($this->students['count_deans_lister'] !== 0) {
            $this->students['new_students'] = $this->deans_list
                                ->where('created_at','>',$last_record)
                                ->get(); //check if there's new student in the table
            $this->students['last_created_at'] = $this->deans_list
                                                       ->all()
                                                       ->last()
                                                       ->created_at; //update the last value
        }
        return (!empty($this->students['last_created_at'])) ? [
                'data'        => $this->students['new_students'] ,
                'count'       => $this->students['count_deans_lister'],
                'success'     => true ,
                'last_record' => $this->students['last_created_at'],
            ] : [
                'data'        => '' ,
                'success'     => false ,
                'last_record' => 0
            ];

    }
}
