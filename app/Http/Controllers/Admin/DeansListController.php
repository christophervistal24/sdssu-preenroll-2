<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use Illuminate\Http\Request;

class DeansListController extends Controller
{
    protected $deans_list;
    public function __construct(DeansList $deans_list)
    {
        $this->deans_list = $deans_list;
    }

    public function index()
    {
        $list = DeansList::with('student')
                            ->get();
        return view('admins.list-of-deanslist',compact('list'));
    }

    public function checkDeansList($last_record)
    {
        $new_students = DeansList::where('created_at','>',$last_record)
                 ->get();
        $last_record = DeansList::all()->last()->created_at;
        if (!empty($new_students)) {
            return ['data' => $new_students , 'success' => true , 'last_record' => $last_record];
        }

    }
}
