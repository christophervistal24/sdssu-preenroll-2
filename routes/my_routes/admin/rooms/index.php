<?php
Route::get('/listofrooms',
    [
        'uses' => 'Admin\RoomController@index',
        'roles' => ['Admin']
    ]
);

Route::post('/listofrooms',
    [
         'uses' => 'Admin\RoomController@store',
        'roles' => ['Admin']
    ]
);

Route::put('/listofrooms',
    [
        'uses' => 'Admin\RoomController@update',
        'roles' => ['Admin']
    ]
);

Route::delete('/deleteroom/{room}',
    [
        'uses' => 'Admin\RoomController@delete',
        'roles' => ['Admin']
    ]
);

