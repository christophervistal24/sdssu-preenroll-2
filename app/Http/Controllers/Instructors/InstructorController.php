<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeAdminProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Instructor;
use App\InstructorSchedule;
use App\Semester;
use App\Student;
use App\Subject;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\AssistantDean;

class InstructorController extends Controller
{
    protected $student_subject;
    protected $instructor_info;
    public function __construct(AssistantDean $assistant_dean)
    {
        $this->assistant_dean = $assistant_dean;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('instructors.index');
    }

    /**
     * [store change password]
     * @param  Request    $request    [description]
     * @param  Instructor $instructor [description]
     * @return [type]                 [description]
     */
    public function store(ChangePasswordRequest $request ,Instructor $instructor)
    {
        $user_account = User::where('id_number',Auth::user()->id_number)->first();
        $user_account->password = $request->new_password;
        $user_account->save();
        return redirect()->back()->with('status','Successfully update your password');
    }

    /**
     * [update update information]
     * @param  Request    $request    [description]
     * @param  Instructor $instructor [description]
     * @return [type]                 [description]
     */
    public function update(ChangeAdminProfileRequest $request , Instructor $instructor)
    {
         $assistant_dean = $this->assistant_dean
                              ->where('name',
                                Instructor::find(Auth::user()->id_number)->name
                            )->first();
        //checking if instructor is also the assistant dean
        if ($assistant_dean) {
            $assistant_dean->name = $request->fullname;
            $assistant_dean->education_qualification = $request->education_qualification;
            $assistant_dean->mobile_number = $request->mobile_number;
            $assistant_dean->active = $request->status;
            $assistant_dean->save();
        }

        $instructor->name = $request->fullname;
        $instructor->education_qualification = $request->education_qualification;
        $instructor->mobile_number = $request->mobile_number;
        $instructor->active = $request->status;
        $instructor->save();
        return redirect()->back()->with('status','Successfully update your profile');
    }

    public function changeprofile(Request $request)
    {
        $this->validate($request,[
            'profile' => 'mimes:jpeg,jpg,png,gif|required|max:10000',
        ]);
        ;
        $assistant_dean = $this->assistant_dean
                              ->where('name',
                                Instructor::find(Auth::user()->id_number)->name
                            )->first();
        //checking if instructor is also the assistant dean
        if ($assistant_dean) {
            $image = request()->file('profile');
            $assistant_dean->profile  = $image->getClientOriginalName();
            $assistant_dean->save();
        }
        //update the image of user in DB
        $image = request()->file('profile');
        $instructor = Instructor::find(Auth::user()->id_number);
        $instructor->profile = $image->getClientOriginalName();
        $instructor->save();

        //move the uploaded file
        if ($instructor) {
            $destination = storage_path('/app/public/profile/');
            $image->move($destination,$image->getClientOriginalName());
            return redirect()->back()->with('status','Successfully update your profile image');
        } else {
            return redirect()->back()->withErrors('Please check the image that you want to upload.');
        }
    }

    public function students($first_subject,$second_subject = null)
    {

        return view('instructors.students');
    }


    public function sendsms()
    {
    	return view('instructors.sendsms');
    }

    public function login()
    {
    	return view('instructors.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/instructorlogin');
    }


    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Instructor')) {
            // Authentication passed...
            return redirect()->intended('/instructor/schedule');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
