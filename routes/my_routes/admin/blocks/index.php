<?php

Route::get('/blocks' ,[
        'uses' => 'Admin\BlockController@retrieveblock',
        'roles' => ['Admin']
    ]
);

Route::get('/block',
    [
        'uses' => 'Admin\BlockController@index',
        'roles' => ['Admin']
    ]
);

Route::post('/block',
    [
        'uses' => 'Admin\BlockController@store',
        'roles' => ['Admin']
    ]
);

Route::put('/upblock',
    [
        'uses' => 'Admin\BlockController@update',
        'roles' => ['Admin']
    ]
);
