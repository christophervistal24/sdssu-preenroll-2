<?php
Route::get('/subjects',
    ['uses' => 'Admin\SubjectController@index','roles' => ['Admin']]
);

Route::post('/subjectcreate',
    ['uses' => 'Admin\SubjectController@store','roles' => ['Admin']]
);

Route::put('/subjectupdate/{subject_info}',
    ['uses' => 'Admin\SubjectController@update','roles' => ['Admin']]
);

Route::get('/subjects/{id}/{course}',
    ['uses' => 'Admin\SubjectController@update','roles' => ['Admin']]
);
