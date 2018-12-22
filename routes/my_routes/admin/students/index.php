<?php
Route::get('/addstudent',
    [
        'uses' => 'Admin\StudentController@create',
        'roles' => ['Admin']
    ]
);

Route::post('/addstudent',
    [
        'uses' => 'Admin\StudentController@store',
        'roles' => ['Admin']
    ]
);

Route::put('/editstudent/{student}',
    [
        'uses' => 'Admin\StudentController@update',
        'roles' => ['Admin']
    ]
);

Route::get('/liststudents',
    [
        'uses' => 'Admin\StudentController@index',
        'roles' => ['Admin']
    ]
);
