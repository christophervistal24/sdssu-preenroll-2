<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Student;

class ParentsController extends Controller
{

    private $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('parents.index');
    }

    public function viewgrade()
    {
        $grades = [];
        $student = $this->student
                        ->find(Auth::user()->id_number);
        $s_grades = $this->student
                         ->with(['grades' => function ($query) {
                                $query->orderBy('created_at');
                         }])->find($student->id_number);
        array_walk_recursive($s_grades->grades, function ($value , $key) use(&$grades) {
        $grades[$value->subject->year.'_year_'.$value->subject->semester.'_semester_subjects']
            [] = $value;
        });
        return view('admins.studentevaluate',compact(['student','grades']));
    }

    public function sendsms()
    {
    	return view('parents.sendsms');
    }

    public function login()
    {
        return view('parents.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/parentlogin');
    }

    public function checkLogin(LoginRequest $request)
    {

        $credentials = $request->only('id_number', 'password');
        $user = User::where('id_number',$request->id_number)->first();
        if (Auth::attempt($credentials) && $user->hasRole('Student')) {
            // Authentication passed...
            return redirect()->intended('/parent/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
