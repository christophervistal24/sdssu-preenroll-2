<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstructor;
use App\Instructor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instructors = Instructor::all();
        return view('admins.list-instructors',compact('instructors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.addinstructor');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstructor $request)
    {
         DB::beginTransaction();
         try {
            Instructor::create([
                'id_number'               => $request->id_number,
                'name'                    => $request->name,
                'education_qualification' => $request->education_qualification,
                'position'                => $request->position,
                'major'                   => $request->major,
                'status'                  => $request->status,
                'mobile_number'           => $request->mobile_number,
            ]);
            $user = User::create([
                'id_number' => $request->id_number,
                'password'  => bcrypt($request->password),
            ]);
            $user->roles()->attach($user->getRole('Instructor'));
            DB::commit();
        } catch (\Exception $e) { //rollback
            DB::rollback();
        }
       return redirect()->back()->with('status','Successfully add new instructor');
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
    public function update(Request $request,Instructor $info)
    {
        $info->active                  = ($request->active == 'Active') ? 1 : 0;
        $info->education_qualification = $request->education_qualification;
        $info->major                   = $request->major;
        $info->id_number               = $request->id_number;
        $info->mobile_number           = $request->mobile_number;
        $info->name                    = $request->name;
        $info->position                = $request->position;
        $info->status                  = $request->status;
        $info->save();
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
