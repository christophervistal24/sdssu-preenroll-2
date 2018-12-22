<?php
Route::get('/instructors',
    [
        'uses' => 'Admin\InstructorController@index',
        'roles' => ['Admin']
    ]
);

Route::get('/addinstructor',
    [
        'uses' => 'Admin\InstructorController@create',
        'roles' => ['Admin']
    ]
);

Route::put('/instructor/{info}',
    [
        'uses' => 'Admin\InstructorController@update',
        'roles' => ['Admin']
    ]
);

Route::post('/addinstructor',
    [
        'uses' => 'Admin\InstructorController@store',
        'roles' => ['Admin']
    ]
);

