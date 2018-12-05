<?php

namespace App\Http\Controllers\Students;

use App\Block;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\InstructorSchedule;
use App\PreEnroll;
use App\Schedule;
use App\Semester;
use App\Student;
use App\StudentGrade;
use App\StudentSubject;
use App\Subject;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class StudentController extends Controller
{
    private $subject;
    public function __construct(Subject $sub)
    {
        $this->subject = $sub;
        $this->middleware('preventBackHistory');
    }

	public function index()
	{
		return view('students.index');
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

    public function checkLogin(LoginRequest $request)
    {
        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        // $isStudentCanLogin = $this->student
        //                         ->checkIfCanLogin($request->id_number,$this->sem);
        // if ($isStudentCanLogin) {
        //   return Redirect::back()
        //             ->withInput()
        //             ->withErrors('You can\'t login on this page please wait till administrator make an action');
        // }
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
            return redirect()->intended('/student/index');
        }

        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
