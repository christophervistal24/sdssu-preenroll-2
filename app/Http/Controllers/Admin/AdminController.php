<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Role;

class AdminController extends Controller
{

    public function __construct()
    {
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
            'status'                  => 'required',
        ]);

        $instructor_create = Instructor::create([
            'name'                    => $request->name,
            'id_number'               => $request->id_number,
            'education_qualification' => $request->education_qualification,
            'major'                   => $request->education_qualification,
            'status'                  => $request->status,
        ]);

        $instructor_create->save();
        if ($instructor_create) {
            $user = User::create([
                'name'      => $request->name,
                'id_number' => $request->id_number,
                'password'  => bcrypt($request->password),
                'email'     => $request->email,
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
            'password' => 'required',
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
