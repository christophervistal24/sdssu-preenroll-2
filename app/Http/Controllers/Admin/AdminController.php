<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\InstructorSchedule;
use App\Role;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function preenrol()
    {
        return view('admins.pre-enrol');
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
            'major'                   => 'required',
            'position'                => 'required',
            'status'                  => 'required',
        ]);

        $instructor_create = Instructor::create(
            [
                'name'                    => $request->name,
                'id_number'               => $request->id_number,
                'education_qualification' => $request->education_qualification,
                'major'                   => $request->major,
                'position'                => $request->position,
                'status'                  => $request->status,
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
        return view('admins.schedule');
    }

    public function scheduling()
    {
    	return view('admins.scheduling');
    }

    public function storeschedule(Request $request)
    {
        $request->validate([
            'start_time' => 'required',
            'end_time'   => 'required',
            'days'       => 'required',
            'room'       => 'required',
            'subject'    => 'required',
            'instructor' => 'required',
        ]);
        
        $is_exists = $this->instructorSchedule->checkSchedule([
             'start_time' => $request->start_time,
             'end_time'   => $request->end_time,
             'days'       => $request->days,
             'room'       => $request->room,
             'subject'    => $request->subject,
             'instructor' => $request->instructor,
        ]);

        if (!$is_exists) {
            $user = InstructorSchedule::create([
                 'start_time' => $request->start_time,
                 'end_time'   => $request->end_time,
                 'days'       => $request->days,
                 'room'       => $request->room,
                 'subject'    => $request->subject,
                 'instructor' => $request->instructor,
            ])->save();
            return redirect()->back()->with('status','Successfully add new schedule for ' . $request->instructor);
        }
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
