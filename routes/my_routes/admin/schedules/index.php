<?php

Route::get('/schedule',
    [
            'uses' => 'Admin\ScheduleController@index',
            'roles' => ['Admin']
    ]
);

Route::get('/scheduling',
    [
        'uses' => 'Admin\ScheduleController@create','roles' => ['Admin']
    ]
);

Route::post('/scheduling',
    [
        'uses' => 'Admin\ScheduleController@store',
        'roles' => ['Admin']
    ]
);

Route::put('/updateschedule',
    [
        'uses' => 'Admin\ScheduleController@update',
        'roles' => ['Admin']
    ]
);
