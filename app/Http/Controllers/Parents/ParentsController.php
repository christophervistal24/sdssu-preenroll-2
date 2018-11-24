<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ParentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('preventBackHistory');
    }

    public function index()
    {
        return view('parents.index');
    }

    public function viewgrade()
    {
    	return view('parents.viewgrade');
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
        if (Auth::attempt($credentials) && $user->hasRole('Parent')) {
            // Authentication passed...
            return redirect()->intended('/parent/index');
        }
        return Redirect::back()->withInput()->withErrors('Wrong ID number/password combination.');
    }
}
