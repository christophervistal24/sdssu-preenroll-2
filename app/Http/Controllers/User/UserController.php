<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function index()
	{
		$users = User::all();
		return view('index',compact('users'));
	}

	public function sample()
	{
		return view('testing');
	}

	public function sample2()
	{
		return view('welcome');
	}

	public function login(Request $request)
	{
		 $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/preenrol');
        }
	}
}
