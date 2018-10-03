<?php

namespace App\Http\Controllers\Parents;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
