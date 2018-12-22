<?php

Route::get('/student/{id_number}',
    [
        'uses' => 'Admin\StudentEvaluateController@show',
        'roles' => ['Admin']
    ]
);

Route::get('/student/print/grade/{id_number}/{current_semester}/{subject_year}/{is_report?}',
    [
        'uses' => 'Admin\StudentEvaluatePrintController@show',
        'roles' => ['Admin','Student']
    ]
);

Route::get('/student/print/grades',
    [
        'uses' => 'Admin\StudentEvaluatePrintController@print_range',
        'roles' => ['Admin','Student']
    ]
);

Route::post('/student/{id_number}',
    [
        'uses' => 'Admin\StudentEvaluatePrintController@printrange',
        'roles' => ['Admin']
    ]
);
