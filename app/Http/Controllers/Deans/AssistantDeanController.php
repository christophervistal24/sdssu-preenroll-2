<?php

namespace App\Http\Controllers\Deans;
use App\AssistantDean;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Instructor;
use App\Schedule;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\InstructorSchedule;

class AssistantDeanController extends Controller
{
	public function index()
	{
		$no_of_scheduled = DB::table('instructor_schedule')->get()->count();
		$no_of_schedule = DB::table('schedules')->get()->count();
		$schedules =  DB::select('
			SELECT
	    GROUP_CONCAT(schedules.id) as schedule_id,
        schedules.start_time,
        schedules.end_time,
	    GROUP_CONCAT(schedules.days) AS days,
	    schedules.room,
	    subjects.id AS subject_id,
	    subjects.sub,
	    GROUP_CONCAT(subjects.sub_description) AS subject,
	    schedules.block,
	    instructors.id_number as instructor_id_number,
	    instructors.name as instructor_name ,
	    blocks.level ,
	    blocks.block_name ,
	    blocks.course
	FROM
	    schedules
	LEFT JOIN instructor_schedule ON schedules.id = instructor_schedule.schedule_id
	LEFT JOIN instructors ON instructor_schedule.instructor_id_number = instructors.id_number
	INNER JOIN subjects ON schedules.subject_id = subjects.id
	INNER JOIN blocks ON schedules.block = blocks.id
    WHERE schedules.status = "active"
	GROUP BY subject_id , instructors.id_number
        ');
		// dd($schedules);
    	return view('deans.assistant.listschedule',compact('schedules','no_of_schedule','no_of_scheduled'));
	}

	public function assign(Schedule $schedule_info , Schedule $schedule_info2 = null)
	{
		$instructors = Instructor::all();
    	return view('deans.assistant.index',compact(['instructors','schedule_info','schedule_info2']));
	}

	public function submitassign(Request $request, Schedule $schedule_info , Schedule $schedule_info2 = null)
	{
		$instructor_id_number = Instructor::where('name',$request->instructor_name)
										->first()
										->id_number;
		try {
			$schedule_info->instructors()->attach($instructor_id_number);
			if (isset($schedule_info2)) {
				$schedule_info2->instructors()->attach($instructor_id_number);
			}
		} catch (Exception $e) {
			return redirect('/assistantdean/index')->with('status',$schedule_info->subject->sub_description . ' is now assign to ' . $request->instructor_name);
		}
		return redirect('/assistantdean/index')->with('status',$schedule_info->subject->sub_description . ' is now assign to ' . $request->instructor_name);
	}

	public function edit(Instructor $instructor_id_no , Schedule $schedule_id)
	{
		$instructors = Instructor::all();
		$instructor = $instructor_id_no;
		$schedule = $schedule_id;
		return view('deans.assistant.editassign',compact(['instructor','schedule','instructors']));
	}

	public function update(Request $request , Schedule $schedule)
	{
		$instructor_id_number = Instructor::where('name',$request->instructor_name)->first()->id_number;
		$schedule->instructors()->updateExistingPivot($request->instructor_id_number,[
			'instructor_id_number' => $instructor_id_number,
		]);

		return redirect('/assistantdean/index')->with('status',$schedule->subject->sub_description . ' is now assign to ' . $request->instructor_name);
	}

    public function editprofile()
    {
        return view('deans.assistant.profile');
    }

    public function updateprofile(Request $request , AssistantDean $assistantdean)
    {
        $assistantdean->name                    = $request->fullname;
        $assistantdean->education_qualification = $request->education_qualification;
        $assistantdean->mobile_number           = $request->mobile_number;
        $assistantdean->active                  = $request->status;
        $assistantdean->save();
        return redirect()->back()->with('status','Successfully update your profile');
    }

    public function updatepassword(ChangePasswordRequest $request , AssistantDean $assistantdean)
    {
        $user_account = User::where('id_number',Auth::user()->id_number)->first();
        $user_account->password = $request->new_password;
        $user_account->save();
        return redirect()->back()->with('status','Successfully update your password');
    }

    public function changeprofile(Request $request)
    {
		$this->validate($request,[
            'profile' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        //update the image of user in DB
        $image = request()->file('profile');
        $student = AssistantDean::find(Auth::user()->id_number);
        $student->profile = $image->getClientOriginalName();
        $student->save();
        //move the uploaded file
        if ($student) {
            $destination = storage_path('/app/public/profile/');
            $image->move($destination,$image->getClientOriginalName());
            return redirect()->back()->with('status','Successfully update your profile image');
        } else {
            return redirect()->back()->withErrors('Please check the image that you want to upload.');
        }
    }

    public function showLoginForm()
    {
    	return view('deans.assistant.showlogin');
    }

    public function submitlogin(Request $request)
    {
	  		$validatedData = $request->validate([
	            'id_number' => 'required',
	            'password'  => 'required',
	        ]);

	        $credentials = $request->only('id_number', 'password');
	        $admin = User::where('id_number',$request->id_number)->first();
	        if (Auth::attempt($credentials) && $admin->hasRole('Assistant Dean')) {
	            // Authentication passed...
	            return redirect()->intended('/assistantdean/index');
	        }
	        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }

    public function logout()
    {
    	 Auth::logout();
         return redirect('/assistantdeanlogin');
    }
}
