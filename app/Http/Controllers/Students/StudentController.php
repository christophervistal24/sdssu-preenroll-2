<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Semester;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    private $student;
    private $sem;
    public function __construct(Student $studnt,Semester $sem)
    {
        $this->student = $studnt;
        $this->sem = $sem;
        $this->middleware('preventBackHistory');
    }

	public function index()
	{
		return view('students.index');
	}
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

    public function logout()
    {
    	Auth::logout();
    	return redirect('/studentlogin');
    }

    public function checkLogin(Request $request)
    {
        $request->validate([
            'id_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        $isStudentCanLogin = $this->student
                                ->checkIfCanLogin($request->id_number,$this->sem);
        if ($isStudentCanLogin) {
          return Redirect::back()
                    ->withInput()
                    ->withErrors('You can\'t login on this page please wait till administrator make an action');
        }
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
            return redirect()->intended('/student/index');
        }

        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
