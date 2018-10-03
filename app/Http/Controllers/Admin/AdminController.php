<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
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

    public function schedule()
    {
    	return view('admins.schedule');
    }

    public function login()
    {
        return view('admins.login');
    }
}
