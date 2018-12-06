<?php

namespace App\Http\Controllers\Admin;

use App\DeansList;
use App\Http\Controllers\Controller;
use App\Schedule;
use App\Semester;
use App\Student;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{

    private $semester , $deans_list;
    public function __construct(Semester $semester , DeansList $deans_list)
    {
        $this->semester = $semester;
        $this->deans_list = $deans_list;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id_number = Auth::user()->id_number;
        $admin     = User::where('id_number',$id_number)->first();
        $current_sem  = $this->semester //get the current semester
                                 ->where('current',1)->first()->id;

        // $this->deans_list //find all students that qualified for deanslist
        //      ->insertQualifiedForDeansLister(new Student , new Subject);

        if (Auth::attempt(['id_number' => $id_number , 'password' => $request->password])
            && $admin->hasRole('Admin')) { // Authentication passed...

            $this->semester //update all
                 ->query()
                 ->update(['current' => 0]);

            $sem = $this->semester //find the request semester and update
                 ->find($request->semester_id);
            $sem->current = 1;
            $sem->save();

            $this->semester //check action for changing semester
                 ->actionBySemester($current_sem,$request->semester_id,[
                    'schedule_model'  => new Schedule(),
            ]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false , 'value' => $current_sem]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
