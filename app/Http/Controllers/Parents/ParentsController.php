<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ParentsController extends Controller
{
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

    public function checkLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/parent/viewgrade');
        }
        return Redirect::back()->withInput()->withErrors('Wrong username/password combination.');
    }
}
