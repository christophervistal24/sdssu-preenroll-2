<?php

namespace App;

use App\User;
use App\Block;
use App\Events\UpdateBlock;
use App\Grade;
use App\Semester;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;

class Student extends Model
{
    protected $fillable = ['id_number','fullname','year','address','course_id','mobile_number','mothername','fathername','parent_mobile_number'];
    protected $primaryKey = 'id_number';

    public function user()
    {
        return $this->hasOne(User::class,'id_number','id_number');
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class,'grade_student','student_id_number','grade_id');
    }

    public function student_subjects()
    {
        return $this->belongsToMany(Subject::class,'student_subject','student_id_number','subject_id');
    }


    public function course()
    {
        $this->primaryKey = 'course_id';
        return $this->hasOne('App\Course','id');
    }

    public function schedules()
    {
        $this->primaryKey = 'id_number';
        return $this->belongsToMany('App\Schedule','schedule_student','student_id_number','schedule_id')
       ->withTimestamps();
    }

    public function deanslister()
    {
        return $this->hasOne('App\DeansList','student_id_number');
    }

    public function block()
    {
        return $this->belongsTo('App\Block','block','id');
    }

    public function getStudentYearLevel($id_number)
    {
    	$getStudenYear = $this->where('id_number',$id_number)->first();
    	return (is_null($getStudenYear)) ? null : $getStudenYear->year;
    }

    public function checkIfCanLogin($id_number,Semester $semester)
    {
     return $this->getStudentYearLevel($id_number) == 1 && $semester->getCurrentSemester() != 'Second semester';
    }

    public function getGrades($parameters)
    {
        /**
         * [as total_units "Subjects that meet the below 2.0 remarks"]
         */
        $current_sem = Semester::where('current',1)->first()->id;
        return DB::table('students')
                ->join('grade_student', 'students.id_number', '=', 'grade_student.student_id_number')
                ->join('grades', 'grade_student.grade_id', '=', 'grades.id')
                ->join('subjects', function ($join) use($parameters , $current_sem){
                        $join->on('subjects.id','=','grades.subject_id')
                        ->where(
                                //depending on current semester , student course , and student year_level
                                [
                                    'subjects.semester' => $current_sem,
                                    'subjects.course'   => $parameters['student_course'],
                                    'subjects.year'     => $parameters['student_year'],
                                ]
                        );
                })
                ->whereNotNull('grades.remarks')
                ->whereBetween('grades.remarks',[1.0,2.0])
                ->groupBy('students.id_number')
                ->orderBy('students.id_number','DESC')
                ->selectRaw('students.id_number,SUM(subjects.units) as total_units , students.year , students.course_id')
                ->get()
                ->toArray();
    }

    public function updateStudentBlock($block)
    {
        $student = $this->find(Auth::user()->id_number);
        $blockModel = new Block;
        if (empty($student->block)) {
            $find_block = $blockModel->find($block); //get other columns of the block
            $blockModel->findOrFail($find_block->id) //update the block
                   ->update(['no_of_enrolled' => ($find_block->no_of_enrolled + 1)]) ;
           \Event::fire( new UpdateBlock(new Block,$block)); // fire an event to check if block is full
           $student->block =  $block; // assign block to student
           $student->save();
        }
    }

    public function sendSMS(int $student_id_number)
    {
        $grade = Grade::with('subject')->find(request('grade_id'));
        $subject_code = $grade->subject->sub;
        $subject_description = $grade->subject->sub_description;
        $grade = request('student_grade');
        $student_credentials = $this->find($student_id_number);
        $config        = Configuration::getDefaultConfiguration();
        $config->setSSLVerification(false); // add this line
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0ODYzNjE3MSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY1MDk1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.1FCQ9PayjBORH7y4CPd1ZuQKyByKHer2gvWzFC2BoPk');
        $apiClient     = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $student_credentials->parent_mobile_number,
            'message' => $subject_code . '-' . $subject_description . ' , ' . $grade,
            'deviceId' => 108141
        ]);
             $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest1,
            ]);
    }

    public static function sendSchedule($message)
    {
        $config        = Configuration::getDefaultConfiguration();
        $config->setSSLVerification(false); // add this line
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTU0ODYzNjE3MSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjY1MDk1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.1FCQ9PayjBORH7y4CPd1ZuQKyByKHer2gvWzFC2BoPk');
        $apiClient     = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $student_mobile_number = Student::find(Auth::user()->id_number)->mobile_number;
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $student_mobile_number,
            'message' => $message,
            'deviceId' => 108141
        ]);
             $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest1,
            ]);
    }

}
