<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeAdminProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Instructor;
use App\Schedule;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
       $ce_students = Student::where('course_id',1)->get()->count();
       $cs_students = Student::where('course_id',2)->get()->count();
       $instructors = Instructor::all()->count();
       $blocks = Block::all()->count();
       $schedules = Schedule::all()->count();
       return view('admins.index',compact('ce_students','cs_students','instructors','blocks','schedules'));
    }

    public function login()
    {
        return view('admins.login');
    }

    public function edit()
    {
        $admin_information = Admin::find(Auth::user()->id_number);
        return view('admins.profile.index',compact('admin_information'));
    }

    public function update(ChangeAdminProfileRequest $request , Admin $id_number)
    {

        $information                          = $id_number;
        $information->name                    = $request->fullname;
        $information->education_qualification = $request->education_qualification;
        $information->mobile_number           = $request->mobile_number;
        $information->active                  = $request->status;

        $information->save();
        return redirect()->back()->with('status','Successfully update your profile');
    }

    public function store(ChangePasswordRequest $request , Admin $id_number)
    {
        $user_account = User::where('id_number',Auth::user()->id_number)->first();
        $user_account->password = $request->new_password;
        $user_account->save();
        return redirect()->back()->with('status','Successfully update your password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/adminlogin');
    }


    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->only('id_number', 'password');
        $admin = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $admin->hasRole('Admin')) {
            // Authentication passed...
            return redirect()->intended('/admin/index');
        }
        return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors('Wrong ID number/password combination.');
    }
}
