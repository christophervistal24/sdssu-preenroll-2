<?php

namespace App\Http\Controllers\Admin;
use App\Block;
use App\Course;
use App\Http\Controllers\Controller;
use App\Instructor;
use App\InstructorSchedule;
use App\PreEnroll;
use App\PreEnrolled;
use App\Role;
use App\Room;
use App\Semester;
use App\Student;
use App\StudentParent;
use App\StudentSubject;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Model\SendMessageRequest;


class AdminController extends Controller
{

    private $instructorSchedule;

    public function __construct(InstructorSchedule $instructorSchedule)
    {
        $this->instructorSchedule = $instructorSchedule;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
       return view('admins.index');
    }

    public function changesemester(Request $request)
    {
        Semester::query()->update(['current' => 0]);
        $sem = Semester::find($request->semested_id);
        $sem->current = 1;
        $sem->save();
        return response()->json(['success' => true]);
    }

    public function preenrol()
    {
        $student_preenroll = DB::table('pre_enrolls')
                            ->join('instructor_schedules','pre_enrolls.schedule_id','=','instructor_schedules.id')
                            ->leftJoin('students','pre_enrolls.student_id','=','students.id')
                            ->select('pre_enrolls.student_id','students.fullname','pre_enrolls.created_at')
                            ->groupBy('pre_enrolls.student_id')
                            ->get();
        return view('admins.pre-enrol',compact('student_preenroll'));
    }

    public function acceptpreenroll(Student $student_info)
    {
        $student_request = PreEnroll::with('schedule')
                            ->where('student_id',$student_info->id)
                            ->get();
       return view('admins.view-preenrollrequest',compact('student_request','student_info'));
    }

    public function storeacceptpreenroll(Request $request)
    {
        $request->validate([
            'sched_id.*' => 'required'
        ]);
        $schedule_request = $request->sched_id;
        array_walk($schedule_request, function (&$values) use($request) {
            StudentSubject::create([
                'subject_id' => $values,
                'student_id' => $request->student_id
            ]);
        });
        PreEnroll::where('student_id',$request->student_id)->delete();
        $update_student_block = Student::find($request->student_id);
        $update_student_block->block = $request->block;
        $update_student_block->save();
        Block::where('level',Student::find($request->student_id)->first()->year)->increment('no_of_enrolled');
        return redirect()->back()->with('status','Success!');
    }

    public function addgrades()
    {
    	return view('admins.addgrades');
    }

    public function addinstructor()
    {
    	return view('admins.addinstructor');
    }

    public function storeinstructor(Request $request)
    {
        $request->validate([
            'name'                    => 'required',
            'id_number'               => 'required|unique:instructors',
            'password'                => 'required',
            'education_qualification' => 'required',
            'position'                => 'required',
            'status'                  => 'required',
            'mobile_number'           => 'required',
        ]);

        $instructor_create = Instructor::create(
            [
                'name'                    => $request->name,
                'id_number'               => $request->id_number,
                'education_qualification' => $request->education_qualification,
                'major'                   => $request->major,
                'position'                => $request->position,
                'status'                  => $request->status,
                'mobile_number'           => $request->mobile_number,
            ]
        )->save();

        if ($instructor_create) {
            $user = User::create([
                'name'      => $request->name,
                'id_number' => $request->id_number,
                'password'  => bcrypt($request->password),
            ]);
            $user->save();
            $user->roles()->attach($user->getRole('Instructor'));
            return redirect()->back()->with('status','Successfully add new instructor');
        }
    }

    public function schedule()
    {
        $schedules = InstructorSchedule::where('status','active')->get();
        $deleted_schedules = InstructorSchedule::where('status','delete')->get();
        return view('admins.schedule',compact('schedules','deleted_schedules'));
    }

    public function scheduling()
    {
    	return view('admins.scheduling');
    }

    public function restoreschedule($id)
    {
        $schedule = InstructorSchedule::where('id',$id)->first();
        $schedule->status = 'active';
        $schedule->save();
        if ($schedule) {
            return response()->json(['success' => true]);
        }
    }

    public function permanentdelete($id)
    {
        $schedule = InstructorSchedule::find($id);
        $schedule->delete();
        if ($schedule) {
            return response()->json(['success' => true]);
        }
    }

    public function storeschedule(Request $request)
    {
        $subject_level = Subject::where('sub_description',array_values($request->subject)[0])
                                        ->first()
                                        ->year;
        $block = $subject_level . array_keys($request->subject)[0] .
        Block::getNoOfEnrolled($subject_level)[0]->block_name;
        $request->validate([
            'start_time' => 'required',
            'end_time'   => 'required',
            'days'       => 'required',
            'room'       => 'required',
            'subject'    => 'required',
            'instructor' => 'nullable',
        ]);

        $is_exists = $this->instructorSchedule->checkSchedule([
             'start_time' => $request->start_time,
             'end_time'   => $request->end_time,
             'days'       => $request->days,
             'room'       => $request->room,
             'subject'    => array_values($request->subject)[0],
             'block'      => $block
        ]);

        if (!$is_exists) {
            $user = InstructorSchedule::create([
                 'start_time' => $request->start_time,
                 'end_time'   => $request->end_time,
                 'days'       => $request->days,
                 'room'       => $request->room,
                 'subject'    => array_values($request->subject)[0],
                 'block'      => $block,
                 'instructor' => $request->instructor,
            ]);
            return redirect()->back()->with('status','Successfully add new schedule for ' . $request->instructor);
        } else {
            return redirect()->back()->withErrors('This schedule is already exists');
        }
    }

    public function instructors()
    {
        $instructors = Instructor::all();
        return view('admins.list-instructors',compact('instructors'));
    }

    public function instructorinfo($id)
    {
        return response()->json(Instructor::where('id',$id)->first());
    }

    public function updateinstructorinfo(Request $request)
    {
        $instructor_info = Instructor::where('id_number',$request->id_number)->first();
        $instructor_info->id_number = $request->id_number;
        $instructor_info->name = $request->name;
        $instructor_info->education_qualification = $request->education_qualification;
        $instructor_info->position = $request->position;
        $instructor_info->status = $request->status;
        $instructor_info->mobile_number = $request->mobile_number;
        $instructor_info->active = $request->active;
        $instructor_info->save();

        if ($instructor_info) {
            return response()->json(['success' => true]);
        }
    }

    public function updatescheduleinfo(Request $request)
    {
        $schedule_info = instructorSchedule::where('id',$request->id)->first();
        $schedule_info->start_time = $request->start_time;
        $schedule_info->end_time = $request->end_time;
        $schedule_info->instructor = $request->instructor;
        $schedule_info->days = $request->days;
        $schedule_info->subject = $request->subject;
        $schedule_info->save();
        if ($schedule_info) {
            return response()->json(['success' => true]);
        }
    }

    public function deleteschedule(Request $request){
        $schedule_info = InstructorSchedule::where('id',$request->id)->first();
        $schedule_info->status = "delete";
        $schedule_info->save();
        return response()->json(['success' => true]);
    }

    public function getschedule($id)
    {
        return response()->json(InstructorSchedule::where('id',$id)->first());
    }

    public function addroom(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms'
        ]);

        if ($request->id == 0) {
            $create = Room::create([
            'room_number' => $request->room_number,
            ])->save();
            return redirect()->back()->with('status', 'Room ' . $request->room_number  . ' successfully add');
        } else {
            $room = Room::find($request->id);
            $room->room_number = $request->room_number;
            $room->save();
            return redirect()->back()->with('status', 'Successfully update a room');
        }
    }

    public function deleteroom($id)
    {
        if ($id) {
            $room = Room::find($id);
            $room->delete();
            return redirect()->back()->with('status', 'Successfully delete a room');
        }
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view('admins.subjects',compact('subjects'));
    }

    public function subjectstore(Request $request)
    {
        if ($request->subject_id == 0) {
            Subject::create([
                'sub'             => $request->subject_sub,
                'sub_description' => $request->subject_description,
                'units'           => $request->subject_units,
                'prereq'          => $request->subject_prereq,
                'year'            => $request->subject_year,
                'semester'        => $request->subject_semester,
            ])->save();
        }
        else {
            $subject = Subject::find($request->subject_id);
            $subject->sub             = $request->subject_sub;
            $subject->sub_description = $request->subject_description;
            $subject->units           = $request->subject_units;
            $subject->prereq          = $request->subject_prereq;
            $subject->year            = $request->subject_year;
            $subject->semester        = $request->subject_semester;
            $subject->save();
        }
        return response()->json(['data' => 'success']);
    }

    public function addstudent()
    {
        $courses = Course::all();
        return view('admins.addstudent',compact('courses'));
    }

    public function storestudent(Request $request)
    {
        $role_student = Role::where('name','Student')->first();
        $request->validate([
            'id_number'        => 'required|unique:students',
            'student_fullname' => 'required',
            'course'           => 'required',
            'student_mobile'   => 'required',
            'mothersname'      => 'required',
            'fathersname'      => 'required',
            'parent_mobile'    => 'required'
        ]);

        $parent = new StudentParent;
        $parent->mothername = $request->mothersname;
        $parent->fathername = $request->fathersname;
        $parent->mobile_number = $request->parent_mobile;
        $parent->save();

        $student_create = Student::create([
            'id_number' => $request->id_number,
            'fullname'  => $request->student_fullname,
            'year'      => 1,
            'course_id' => $request->course,
            'student_parent_id' => $parent->id
        ]);

        $new_student = User::create([
            'name'      => $request->student_fullname,
            'id_number' => $request->id_number,
            'password'  => bcrypt(1234),
        ]);
        $new_student->roles()->attach($role_student);

        if ($student_create) {
             return redirect()->back()->with('status',"<a href=/admin/studentsubject/".$student_create->id." class=alert-link> Successfully add new student name " . $request->student_fullname . " click this message to add a subject</a>");
        }
    }

    public function studentaddsubject(Student $student)
    {
        //combine the year level and course of student to get specific subjects
        $bracket = $student->year . $student->course->course_code;
        //get the subjects of students
        $already_add = Student::with('subjects')->where('id',$student->id)->get();
        //get by year
        $schedules = InstructorSchedule::where('status','active')
                                        ->where('block','like','%' . $bracket . '%')
                                        ->get();
        return view('admins.studentaddsubject',compact(['student','schedules','already_add']));
    }

    public function storestudentsubject(Request $request)
    {
         if ($request->subjects == null) { //check if the admin add some subjects
            return Redirect::back()->withErrors('Please add some subject.');
         }

        array_map(function ($schedule_id) use($request)  { //iterate and insert the subjects
            $student_subject = new StudentSubject();
            $student_subject->student_id = $request->user_id;
            $student_subject->subject_id = $schedule_id;
            $student_subject->timestamps = false;
            $student_subject->save();
        },array_keys($request->subjects));

        //update the block of the student in STUDENTS table
        $student = Student::with('subjects')->where('id',$request->user_id)->first()->subjects;
        $update_student_block = Student::find($request->user_id);
        $update_student_block->block = $student[0]->block[3]; //get the block and get the last character
        $update_student_block->save();
        Block::where('level',Student::find($request->user_id)->first()->year)->increment('no_of_enrolled');
        return redirect()->back()->with('status','Successfully add a subject');
    }

    public function students()
    {
        $students = Student::with('parents')->get();
        return view('admins.list-of-students',compact('students'));
    }

    public function login()
    {
        return view('admins.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/adminlogin');
    }

    public function sendschedule($number)
    {
        return view('admins.send',compact('number'));
    }

    public function sendtoschedule(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'message'      => 'required'
        ]);
        $config        = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzODg4MTY4NSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjQ3NTk1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.89tHnbHlSQyrSDLjhKl-7UdPzWxSkkBK2I5n0nnEc1U');
        $apiClient     = new ApiClient($config);
        $messageClient = new MessageApi($apiClient);

        // Sending a SMS Message
        $sendMessageRequest1 = new SendMessageRequest([
            'phoneNumber' => $request->phone_number,
            'message' => $request->message,
            'deviceId' => 103181
        ]);
        {
             $sendMessages = $messageClient->sendMessages([
                $sendMessageRequest1,
            ]);
        }
        if ($sendMessages) {
            return redirect()->back()->with('status','Successfully send a message to ' . $request->phone_number);
        }
    }

    public function listofrooms()
    {
        $rooms = Room::all();
        return view('admins.listrooms',compact('rooms'));
    }
    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'id_number' => 'required',
            'password'  => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');
        $admin = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $admin->hasRole('Admin')) {
            // Authentication passed...
            return redirect()->intended('/admin/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
