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


Route::group(['prefix' => 'admin','middleware' => ['roles','auth']], function() {
		Route::get('/index',['uses'=>'Admin\AdminController@index','roles' => ['Admin']]);
		Route::get('/pre-enrol',['uses'=>'Admin\AdminController@preenrol','roles' => ['Admin']]);
		Route::get('/addgrades',['uses'=>'Admin\AdminController@addgrades','roles' => ['Admin']]);
		Route::get('/schedule',['uses'=>'Admin\AdminController@schedule','roles' => ['Admin']]);
		Route::get('/scheduling',['uses'=>'Admin\AdminController@scheduling','roles' => ['Admin']]);
		Route::post('/scheduling',['uses'=>'Admin\AdminController@storeschedule','roles' => ['Admin']]);
		Route::get('/addinstructor',['uses'=>'Admin\AdminController@addinstructor','roles' => ['Admin']]);
		Route::post('/addinstructor',['uses'=>'Admin\AdminController@storeinstructor','roles' => ['Admin']]);
		Route::get('/index',['uses'=>'Admin\AdminController@index','roles' => ['Admin']]);
		Route::get('/logout',['uses'=>'Admin\AdminController@logout','roles' => ['Admin']]);
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
	Route::get('/preenrol',['uses'=>'Students\StudentController@preenrol','roles' => ['Student']]);
	Route::get('/evaluate',['uses'=>'Students\StudentController@evaluate','roles' => ['Student']]);
	Route::get('/schedule',['uses'=>'Students\StudentController@schedule','roles' => ['Student']]);
	Route::get('/sendsms',['uses'=>'Students\StudentController@sendsms','roles' => ['Student']]);
	Route::get('/index',['uses'=>'Students\StudentController@index','roles' => ['Student']]);
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
	Route::get('/schedule', ['uses' => 'Instructors\InstructorController@schedule','roles' => ['Instructor']]);
    Route::get('/sendsms', ['uses' => 'Instructors\InstructorController@sendsms','roles' => ['Instructor']]);
    Route::get('/logout', ['uses' => 'Instructors\InstructorController@logout','roles' => ['Instructor']]);
});

Route::get('/test','User\UserController@index');
