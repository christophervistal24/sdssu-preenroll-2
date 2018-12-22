<?php
Route::post('/index',
    [
        'uses' => 'Admin\SemesterController@update',
        'roles' => ['Admin']
    ]
);
