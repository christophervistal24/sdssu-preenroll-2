<?php

namespace App\Http\Controllers\Instructors;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InstructorController extends Controller
{
    public function __construct()
    {
         $this->middleware('preventBackHistory');
    }
    
    public function index()
    {
        return view('instructors.index');
    }

    public function schedule()
    {
    	return view('instructors.schedule');
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


    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $user = User::where('email',$request->email)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Instructor')) {
            // Authentication passed...
            return redirect()->intended('/instructor/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong username/password combination.');
    }
}
