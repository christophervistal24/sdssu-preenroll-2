<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Support\Facades\Storage;

class ImportStudent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncating students related tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('students')->truncate();
        DB::table('student_parents')->truncate();
        DB::table('student_subject')->truncate();
        DB::table('schedule_student')->truncate();
        DB::table('grades')->truncate();
        DB::table('grade_student')->truncate();
        DB::table('users')->truncate();
        DB::table('user_role')->truncate();
    }
}
