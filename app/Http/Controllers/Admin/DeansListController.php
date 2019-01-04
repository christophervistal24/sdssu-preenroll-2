<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
       dd('Please write the send logic');

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
