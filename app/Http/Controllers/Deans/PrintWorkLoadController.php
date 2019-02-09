<?php

namespace App\Http\Controllers\Deans;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Instructor;

class PrintWorkLoadController extends Controller
{
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
    public function show($id_number)
    {
         //checking if the route request previous or new schedules\
        //of the instructor


        //query to database
        $instructors = Instructor::where('id_number',$id_number)
                            ->with(['schedules' => function ($q)  {
                               $q->where('status','!=','delete'); 
                            }])->get();
        //load the pdf to the view
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('deans.assistant.printforms.schedule',compact('instructors'));
        $pdf->setPaper('legal');
        return $pdf->stream();
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
