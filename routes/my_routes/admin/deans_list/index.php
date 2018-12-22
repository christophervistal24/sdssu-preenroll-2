<?php

Route::get('/student-deanslist',
    [
        'uses' => 'Admin\DeansListController@index',
        'roles' => ['Admin']
    ]
);

Route::get('/api/deanslist/{last_record}',
    [
        'uses' => 'Admin\DeansListController@checkDeansList',
        'roles' => ['Admin']
    ]
);