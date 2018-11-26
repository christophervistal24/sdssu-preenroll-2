<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Subject;
use App\SubjectPreRequisite;
use Illuminate\Http\Request;

class PreRequisiteController extends Controller
{
    protected $subject;

    public function __construct(Subject $sub)
    {
        $this->subject = $sub;
    }
    public function checkSubject(Request $request)
    {
        $subjects = $request->session()->push('old_dragged_subjects',$request->subjects);
        $filtered = array_values(filterSubjectId($subjects)); //rebase the keys
        $search_id = null;
        if (!empty($filtered)) {
            $search_id = $filtered;
        } else {
            $search_id = $request->subjects;
        }
        $noPrereq = $this->subject->getPreRequisite($search_id);
        //add validation for grade
        if (!is_null($noPrereq)) {
           return response()->json(['success' => false , 'message' =>  'Grade for ' . $noPrereq->pre_requisite_code . ' is require to get the subject '
           . $this->subject->where('id',$noPrereq->subject_id)->first()->sub_description]);
        }

        return response()->json($noPrereq);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
