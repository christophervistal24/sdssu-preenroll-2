<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Student;
use App\Subject;
use Carbon\Carbon;
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
        $count_deans_lister = DeansList::count();
        if ($count_deans_lister != 0) {
            $new_students = DeansList::where('created_at','>',$last_record)
                 ->get();
            $last_created_at = DeansList::all()->last()->created_at;
        }
        if (!empty($last_created_at)) {
            return ['data' => $new_students , 'count' => count_deans_lister , 'success' => true , 'last_record' => $last_created_at];
        } else {
            return ['data' => '' , 'success' => false , 'last_record' => 0];
        }

    }
}
