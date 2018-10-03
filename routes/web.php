<?php

Route::get('/', function () {
    return view('welcome');
});

Route::post('/',[
	'uses'=>'User\UserController@login',
]);

/**
 * Route for Admin
 */

//login route for admin
Route::get('/adminlogin' , [
	'uses' => 'Admin\AdminController@login',
]);

Route::group([
    'prefix' => 'admin',
    'middleware' => 'roles'
], function() {

	Route::get('/pre-enrol',[
		'uses'=>'Admin\AdminController@preenrol',
		'roles' => ['Admin']
	]);

	Route::get('/addgrades',[
		'uses'=>'Admin\AdminController@addgrades',
		'roles' => ['Admin']
	]);

	Route::get('/schedule',[
		'uses'=>'Admin\AdminController@schedule',
		'roles' => ['Admin']
	]);

	Route::get('/addinstructor',[
		'uses'=>'Admin\AdminController@addinstructor',
		'roles' => ['Admin']
	]);
});


/**
 * Route for student
 */

//login route for student
Route::get('/studentlogin' , [
	'uses' => 'Students\StudentController@login',
]);

Route::group([
    'prefix' => 'student',
    'middleware' => 'roles'
], function() {

	Route::get('/preenrol',[
		'uses'=>'Students\StudentController@preenrol',
		'roles' => ['Student']
	]);

	Route::get('/evaluate',[
		'uses'=>'Students\StudentController@evaluate',
		'roles' => ['Student']
	]);

	Route::get('/schedule',[
		'uses'=>'Students\StudentController@schedule',
		'roles' => ['Student']
	]);

	Route::get('/sendsms',[
		'uses'=>'Students\StudentController@sendsms',
		'roles' => ['Student']
	]);

});

/**
 * Route for parent
 */

//login route for parent
Route::get('/parentlogin' , [
	'uses' => 'Parents\ParentsController@login',
]);


Route::group([
    'prefix' => 'parent',
    'middleware' => 'roles'
], function() {
	Route::get('/sendsms',[
	'uses' => 'Parents\ParentsController@sendsms',
	'roles' => ['Parent'],
	]);

	Route::get('/viewgrade',[
		'uses' => 'Parents\ParentsController@viewgrade',
		'roles' => ['Parent'],
	]);
});

/**
 * Route for instructor
 */


//login route for instructor
Route::get('/instructorlogin' , [
	'uses' => 'Instructors\InstructorController@login',
]);


Route::group([
    'prefix' => 'instructor',
    'middleware' => 'roles'
], function() {

	Route::get('/schedule', [
		'uses' => 'Instructors\InstructorController@schedule',
		'roles' => ['Instructor'],
    ]);
    Route::get('/sendsms', [
		'uses' => 'Instructors\InstructorController@sendsms',
		'roles' => ['Instructor'],
    ]);
});

Route::get('/test','User\UserController@index');