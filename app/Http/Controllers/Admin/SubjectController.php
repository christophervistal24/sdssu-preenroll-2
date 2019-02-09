<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSubject;
use App\Http\Requests\CreateSubject as UpdateSubject;
use App\Subject;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    protected $subject;
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_of_subjects = $this->subject
                                  ->subjectWithPrerequisite();
        $pre_requisite = $this->subject
                               ->subjectPreRequisites();
        return view('admins.subjects',compact('list_of_subjects','pre_requisite'));
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
    public function store(CreateSubject $request)
    {
        $new_subject = Subject::create([ // if the subject has no pre-requisite
                'sub'             => request('subject'),
                'sub_description' => request('subject_description'),
                'units'           => request('units'),
                'year'            => request('year'),
                'course'          => request('course'),
                'semester'        => request('semester'),
       ]);
            $subject = Subject::find($new_subject->id);
            $this->subject
                 ->addPrerequisite($subject,$request->pre_req);
            return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course)
    {
        $subjects = Subject::where(['course' => $course])
                    ->get(['id','sub','sub_description','units','year','course','semester']);
        return response()->json($subjects);
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
    public function update(UpdateSubject $request, Subject $subject_info)
    {
       $subject_info->sub             =  request('subject');
       $subject_info->sub_description = request('subject_description');
       $subject_info->units           = request('units');
       $subject_info->year            = request('year');
       $subject_info->course          = request('course');
       $subject_info->semester        = request('semester');
       $subject_info->save();
       $this->subject->updatePreRequisite($subject_info,$request->pre_req);
       return response()->json(['success' => true]);
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
