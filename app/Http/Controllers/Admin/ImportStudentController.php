<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Helpers\ImportStudentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportStudent;
use App\Student;
use App\Subject;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImportStudentGradeHelper;

class ImportStudentController extends Controller
{
    private $importer , $importerHelper;
    private $models = [];

    public function __construct(ImportStudentGradeHelper $csv)
    {
        $this->models = [
            'subject' => new Subject,
            'student' => new Student,
            'grade'   => new Grade,
            'user'    => new User,
        ];

        $this->importer = new ImportStudentHelper([
            'host'        => '127.0.0.1',
            'db_name'     => 'thesis',
            'db_username' => 'root',
            'db_password' => ''
        ], $this->models['user']);

        $this->importerHelper = $csv;
    }

    public function create()
    {
        return view('admins.importstudents');
    }

    public function store(ImportStudent $request)
    {
         file_put_contents(base_path('storage/app/csv/students.csv'), file_get_contents($request->file('student_csv')));
         $this->importer->insertUsers()->insertStudents()->insertRoles();
         $this->importerHelper->load($request,3);
         $this->importerHelper->insertStudentGrade(
            $this->models['student'],
            $this->models['grade']
         );

        return redirect()->back()->with('status','success');
    }

}
