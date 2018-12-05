<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewStudent;
use App\Role;
use App\Student;
use App\StudentParent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('parents')->get();
        return view('admins.list-of-students',compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('admins.addstudent',compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewStudent $request)
    {
    	//get role for student
        $role_student = Role::where('name','Student')->first();

        DB::beginTransaction();
		try {
		//create new student parent
		$student_parent =  StudentParent::create([
			'mothername'    => $request->mothersname,
			'fathername'    => $request->fathersname,
			'mobile_number' => $request->parent_mobile,
		]);

		//create new student
		$student = Student::create([
			'id_number'         => $request->id_number,
			'fullname'          => $request->student_fullname,
			'year'              => 1,
            'address'           => $request->address,
			'course_id'         => $request->course,
            'address'           => $request->address,
            'gender'            => $request->gender,
			'student_parent_id' => $student_parent->id,
			'mobile_number'		=> $request->mobile_number,
		]);

		//create new user for student
        $new_student = User::create([
            'id_number' => $request->id_number,
            'password'  => bcrypt(1234),
        ]);
        //assign a role for the student
        $new_student->roles()->attach($role_student);
        //if everythings fine commit
		DB::commit();
        return redirect()->back()->with('status',"<a href=/admin/studentsubject/".$student->id." class=alert-link> Successfully add new student name " . $request->student_fullname . " click this message to add a subject</a>");
		} catch (\Exception $e) { //rollback
		    DB::rollback();
		}

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
    public function update(Request $request, Student $student)
    {
        $student->fullname      = $request->fullname;
        $student->address       = $request->student_address;
        $student->gender        = $request->student_gender;
        $student->mobile_number = $request->student_mobile;
        $student->year          = $request->student_year;
        $student->course_id     = $request->student_course;
        $student_parents = $student->parents;
        $student_parents->mothername = $request->student_mother;
        $student_parents->fathername = $request->student_father;
        $student_parents->mobile_number = $request->parent_mobile;
        $student->save();
        $student_parents->save();
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
