<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
	public function preenrol()
	{
		return view('students.preenrol');
	}

	public function evaluate()
	{
		return view('students.evaluate');
	}

	public function schedule()
	{
		return view('students.schedule');
	}

	public function sendsms()
	{
		return view('students.sendsms');
	}

	public function login()
    {
        return view('students.login');
    }

    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/student/preenrol');
        }
        return Redirect::back()->withInput()->withErrors('Wrong username/password combination.');
    }
}
