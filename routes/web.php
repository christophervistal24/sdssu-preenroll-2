<?php

	Route::get('/',['uses' => 'Pages\HomeController@index']);
	Route::get('/about',['uses' => 'Pages\AboutUsController@about']);

	//login route for admin
	Route::get('/adminlogin' , ['uses' => 'Admin\AdminController@login']);
	Route::post('/adminlogin',['uses' => 'Admin\AdminController@checkLogin']);

/**
 * Route for Admin
 */

Route::group(['prefix' => 'admin','middleware' => ['roles']], function() {
	require_once base_path().'/routes/my_routes/admin/bootstrap.php';
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
	Route::get('/sendsms',[	'uses' => 'Parents\ParentsController@sendsms','roles' => ['Parent','Student']]);
	Route::get('/viewgrade',['uses' => 'Parents\ParentsController@viewgrade','roles' => ['Parent','Student']]);
	Route::get('/index',['uses' => 'Parents\ParentsController@index','roles' => ['Parent','Student']]);
	Route::get('/logout',['uses' => 'Parents\ParentsController@logout','roles' => ['Parent','Student']]);
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
	Route::get('/previous/schedule',['uses' => 'Instructors\ScheduleController@previousSchedules','roles' => ['Instructor']]);
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
