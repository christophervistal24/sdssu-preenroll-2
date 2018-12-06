<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeansListController extends Controller
{
    public function index()
    {
        $list = DeansList::with('student')
                            ->get();
        return view('admins.list-of-deanslist',compact('list'));
    }
}
