<?php
Route::get('/import/students',
    [
        'uses' => 'Admin\ImportStudentController@create',
        'roles' => ['Admin']
    ]
);

Route::post('/import/students',
    [
        'uses' => 'Admin\ImportStudentController@store',
        'roles' => ['Admin']
    ]
);
