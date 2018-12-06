<?php

	Route::get('/', function () {
    	return view('welcome');
	});

	Route::get('/about',[
			'uses' => 'Pages\AboutUsController@about',
	]);

	//login route for admin
	Route::get('/adminlogin' , [
		'uses' => 'Admin\AdminController@login',
	]);

	Route::post('/adminlogin',[
		'uses' => 'Admin\AdminController@checkLogin',
	]);

/**
 * Route for Admin
 */

Route::group(['prefix' => 'admin','middleware' => ['roles']], function() {
	Route::get('/',['uses'                    =>'Admin\AdminController@index','roles' => ['Admin']]);
	Route::get('/index',['uses'  => 'Admin\AdminController@index','roles' => ['Admin']]);
	Route::post('/index',['uses' => 'Admin\AdminController@changesemester','roles' => ['Admin']]);
	Route::get('/student-deanslist',['uses' => 'Admin\DeansListController@index','roles' => ['Admin']]);
	Route::get('/addgrades',['uses' => 'Admin\AdminController@addgrades','roles' => ['Admin']]);

	Route::get('/schedule',['uses' =>'Admin\ScheduleController@index','roles' => ['Admin']]);
	Route::get('/scheduling',['uses'               =>'Admin\ScheduleController@create','roles' => ['Admin']]);
	Route::post('/scheduling',['uses'              =>'Admin\ScheduleController@store','roles' => ['Admin']]);
	Route::put('/updateschedule',['uses'              =>'Admin\ScheduleController@update','roles' => ['Admin']]);

	Route::get('/addinstructor',['uses'            =>'Admin\InstructorController@create','roles' => ['Admin']]);
	Route::post('/addinstructor',['uses'           =>'Admin\InstructorController@store','roles' => ['Admin']]);
	Route::get('/addstudent',['uses'            =>'Admin\StudentController@create','roles' => ['Admin']]);
	Route::post('/addstudent',['uses'            =>'Admin\StudentController@store','roles' => ['Admin']]);
	Route::put('/editstudent/{student}',['uses'  =>'Admin\StudentController@update','roles' => ['Admin']]);

	Route::get('/studentsubject/{student}',['uses'            =>'Admin\AdminController@studentaddsubject','roles' => ['Admin']]);
	Route::get('/liststudents',['uses'            =>'Admin\StudentController@index','roles' => ['Admin']]);
	Route::post('/studentsubjectstore',['uses' => 'Admin\AdminController@storestudentsubject','roles' => ['Admin']]);
	Route::get('/instructorinfo/{id}',['uses'      =>'Admin\AdminController@instructorinfo','roles' => ['Admin']]);
	Route::post('/instructorinfo/{id}',['uses'     =>'Admin\AdminController@updateinstructorinfo','roles' => ['Admin']]);
	Route::get('/getscheduleinfo/{id}',['uses'     =>'Admin\AdminController@getschedule','roles' => ['Admin']]);
	Route::post('/updatescheduleinfo/{id}',['uses' =>'Admin\AdminController@updatescheduleinfo','roles' => ['Admin']]);
	Route::post('/deleteschedule/{id}',['uses'     =>'Admin\AdminController@deleteschedule','roles' => ['Admin']]);
	Route::post('/restoreschedule/{id}',['uses'    =>'Admin\AdminController@restoreschedule','roles' => ['Admin']]);
	Route::post('/permanentdelete/{id}',['uses'    =>'Admin\AdminController@permanentdelete','roles' => ['Admin']]);

	Route::get('/listofrooms',['uses'              => 'Admin\RoomController@index','roles' => ['Admin']]);
	Route::post('/listofrooms',['uses'             => 'Admin\RoomController@store','roles' => ['Admin']]);
	Route::put('/listofrooms',['uses'             => 'Admin\RoomController@update','roles' => ['Admin']]);
	Route::delete('/deleteroom/{room}',['uses'             => 'Admin\RoomController@delete','roles' => ['Admin']]);

	Route::get('/subjects',['uses' => 'Admin\SubjectController@index','roles' => ['Admin']]);
	Route::post('/subjectcreate',['uses' => 'Admin\SubjectController@store','roles' => ['Admin']]);

	Route::put('/subjectupdate/{subject_info}',['uses' => 'Admin\SubjectController@update','roles' => ['Admin']]);
	Route::get('/subjects/{id}/{course}',['uses' => 'Admin\SubjectController@update','roles' => ['Admin']]);
	Route::get('/index',['uses'                    =>'Admin\AdminController@index','roles' => ['Admin']]);
	Route::get('/instructors',['uses'              =>'Admin\InstructorController@index','roles' => ['Admin']]);
	Route::put('/instructor/{info}',['uses'              =>'Admin\InstructorController@update','roles' => ['Admin']]);
	Route::get('/send/{number?}',['uses'           =>'Admin\AdminController@sendschedule','roles' => ['Admin']]);
	Route::post('/send',['uses'                    =>'Admin\AdminController@sendtoschedule','roles' => ['Admin']]);
	Route::get('/accept/preenroll/{student_info}',['uses' => 'Admin\Admincontroller@acceptpreenroll','roles' => ['Admin']]);

	Route::post('/accept/preenroll/{student_info}',['uses' => 'Admin\Admincontroller@storeacceptpreenroll','roles' => ['Admin']]);

	Route::get('/blocks' ,['uses' => 'Admin\BlockController@retrieveblock','roles' => ['Admin']]);
	Route::get('/block',['uses' => 'Admin\BlockController@index','roles' => ['Admin']]);
	Route::post('/block',['uses' => 'Admin\BlockController@store','roles' => ['Admin']]);
	Route::put('/upblock',['uses' => 'Admin\BlockController@update','roles' => ['Admin']]);

	Route::get('/student/{id_number}',['uses' => 'Admin\StudentEvaluateController@show','roles' => ['Admin']]);

	Route::get('/student/print/grade/{id_number}/{current_semester}/{subject_year}/{is_report?}',['uses' => 'Admin\StudentEvaluatePrintController@show','roles' => ['Admin','Student']]);

	Route::get('/student/print/grades',['uses' => 'Admin\StudentEvaluatePrintController@print_range','roles' => ['Admin','Student']]);

	Route::post('/student/{id_number}',['uses' => 'Admin\StudentEvaluatePrintController@printrange','roles' => ['Admin']]);


	Route::get('/logout',['uses' =>'Admin\AdminController@logout','roles' => ['Admin']]);
});


/**
 * Route for student
 */

//login route for student
Route::get('/studentlogin' , [
	'uses' => 'Students\StudentController@login',
]);

Route::post('/studentlogin' , [
	'uses' => 'Students\StudentController@checkLogin',
]);

Route::group(['prefix' => 'student','middleware' => 'roles'], function() {
	Route::get('/preenrol',['uses'=>'Students\PreEnrollController@create','roles' => ['Student']]);
	Route::post('/preenrol',['uses'=>'Students\PreEnrollController@store','roles' => ['Student']]);
	Route::put('/preenrol',['uses'=>'Students\ScheduleController@checkSchedule','roles' => ['Student']]);

	Route::get('/preenroldetails',['uses'=>'Students\StudentController@preenroldetails','roles' => ['Student']]);
	Route::get('/evaluate',['uses'=>'Students\EvaluateController@index','roles' => ['Student']]);
	Route::get('/schedule',['uses'=>'Students\ScheduleController@index','roles' => ['Student']]);
	Route::get('/index',['uses'=>'Students\StudentController@index','roles' => ['Student']]);
	Route::post('/checkpreq',['uses'=>'Students\PreRequisiteController@checkSubject','roles' => ['Student']]);
	Route::get('/schedule/{information}',['uses'=>'Admin\ScheduleController@show','roles' => ['Student']]);
	Route::get('/logout',['uses'=>'Students\StudentController@logout','roles' => ['Student']]);
});

/**
 * Route for parent
 */

//login route for parent
Route::get('/parentlogin' , [
	'uses' => 'Parents\ParentsController@login',
]);

Route::post('/parentlogin' , [
	'uses' => 'Parents\ParentsController@checkLogin',
]);


Route::group(['prefix' => 'parent','middleware' => 'roles'], function() {
	Route::get('/sendsms',[	'uses' => 'Parents\ParentsController@sendsms','roles' => ['Parent']]);
	Route::get('/viewgrade',['uses' => 'Parents\ParentsController@viewgrade','roles' => ['Parent']]);
	Route::get('/index',['uses' => 'Parents\ParentsController@index','roles' => ['Parent']]);
	Route::get('/logout',['uses' => 'Parents\ParentsController@logout','roles' => ['Parent']]);
});

/**
 * Route for instructor
 */


//login route for instructor
Route::get('/instructorlogin' , [
	'uses' => 'Instructors\InstructorController@login',
]);

Route::post('/instructorlogin' , [
	'uses' => 'Instructors\InstructorController@checkLogin',
]);

Route::group(['prefix' => 'instructor','middleware' => 'roles'], function() {
	Route::get('/index', ['uses' => 'Instructors\InstructorController@index','roles' => ['Instructor']]);
	Route::get('/schedule',['uses' => 'Instructors\ScheduleController@index','roles' => ['Instructor']]);
    Route::get('/sendsms', ['uses' => 'Instructors\InstructorController@sendsms','roles' => ['Instructor']]);
    Route::get('/students/{subject}', ['uses' => 'Instructors\StudentsController@index','roles' => ['Instructor']]);
    Route::post('/students/{subject?}', ['uses' => 'Instructors\StudentsController@addgrade','roles' => ['Instructor']]);
    Route::put('/students/{subject?}', ['uses' => 'Instructors\StudentsController@editgrade','roles' => ['Instructor']]);

    Route::get('/schedule/print', ['uses' => 'Instructors\PrintScheduleController@index','roles' => ['Instructor']]);

    Route::get('/logout', ['uses' => 'Instructors\InstructorController@logout','roles' => ['Instructor']]);
});

/*ASSISTANT DEAN*/
Route::get('/assistantdeanlogin',['uses' => 'Deans\AssistantDeanController@showLoginForm']);
Route::post('/assistantdeanlogin',['uses' => 'Deans\AssistantDeanController@submitlogin']);
Route::group(['prefix' => 'assistantdean','middleware' => 'roles'], function() {
	Route::get('/index', ['uses' => 'Deans\AssistantDeanController@index','roles' => ['Admin','Assistant Dean']]);

	Route::get('/assign/{schedule_info}/{schedule_info2?}', ['uses' => 'Deans\AssistantDeanController@assign','roles' => ['Assistant Dean']]);
	Route::post('/assign/{schedule_info}/{schedule_info2?}', ['uses' => 'Deans\AssistantDeanController@submitassign','roles' => ['Assistant Dean']]);

	Route::get('/editassign/{instructor_id_no}/{schedule_id}', ['uses' => 'Deans\AssistantDeanController@edit','roles' => ['Assistant Dean']]);

	Route::put('/editassign/{schedule}', ['uses' => 'Deans\AssistantDeanController@update','roles' => ['Assistant Dean']]);

	Route::get('/instructors', ['uses' => 'Deans\AssistantDeanController@instructors','roles' => ['Assistant Dean']]);

    Route::get('/logout', ['uses' => 'Deans\AssistantDeanController@logout','roles' => ['Assistant Dean']]);

});

Route::get('/test','User\UserController@index');
