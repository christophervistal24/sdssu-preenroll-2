<?php
Route::get('/',
    [
        'uses' =>'Admin\AdminController@index',
        'roles' => ['Admin']
    ]
);
Route::get('/index',
    [
        'uses'  => 'Admin\AdminController@index',
        'roles' => ['Admin']
    ]
);
