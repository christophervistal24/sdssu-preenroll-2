<?php

namespace App\Http\Controllers\Students;

use App\Grade;
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
        $noPrereq = $this->subject
                         ->getPreRequisite($search_id)
                         ->toArray();
        if (!empty($noPrereq)) {
            $no_of_pre_req = count($noPrereq);
            $remarks = [];
           foreach ($noPrereq as $key => $value) {
                $remarks['subject' . $key] = Grade::where('subject_id',$this->subject->where('sub',$value)->first()->id)->pluck('remarks')->toJson();
           }
            array_walk_recursive($remarks , function (&$value , $key) {
                if ($value == '[]' || strtolower($value) == "INC" || $value > 3.0) {
                    $value = null;
                }
            });

            $count_remarks = count(array_filter($remarks));
            if ($count_remarks === $no_of_pre_req) {
                return response()->json(['success' => true]);
            } else  {
                return response()->json(['success' => false , 'message' => 'You can click the subject to view the pre-requisite maybe you don\'t a have grade.']);
            }
        }
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
