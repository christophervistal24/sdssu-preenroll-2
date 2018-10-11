<?php

use App\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $first = new Semester();
         $first->semester = 'First semester';
         $first->current = 1;
         $first->save();

         $second = new Semester();
         $second->semester = 'Second semester';
         $second->save();

    }
}
