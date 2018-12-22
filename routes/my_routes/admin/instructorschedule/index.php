<?php
Route::get('/send/{id}',
    [
    'uses' => 'Admin\InstructorSendSchedule@show',
    'roles' => ['Admin']
    ]
);

Route::post('/send',
    [
        'uses' => 'Admin\InstructorSendSchedule@send',
        'roles' => ['Admin']
    ]
);
