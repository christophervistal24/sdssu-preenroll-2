<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImportStudentHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportStudent;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportStudentController extends Controller
{
    private $importer;

    public function __construct(User $user)
    {
        $this->importer = new ImportStudentHelper([
            'host'        => '127.0.0.1',
            'db_name'     => 'thesis',
            'db_username' => 'root',
            'db_password' => ''
        ], $user);
    }

    public function create()
    {
        return view('admins.importstudents');
    }

    public function store(ImportStudent $request)
    {
        file_put_contents(base_path('storage/app/csv/students.csv'), file_get_contents($request->file('student_csv')));
        file_put_contents(base_path('storage/app/csv/parents.csv'), file_get_contents($request->file('student_csv')));

        try {
            DB::beginTransaction();
            $this->importer->insertStudentParents()
                ->insertStudents()
                ->insertUsers()
                ->insertRoles();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        // return redirect()->back()->with('status','success');
    }

}
