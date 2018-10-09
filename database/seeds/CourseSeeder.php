<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('courses')->insert([
       	[
       		'course_name' => 'BACHELOR OF SCIENCE IN CIVIL ENGINEERING',
       		'course_code' => 'BSCE',
       	],
       	[
       		'course_name' => 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',
       		'course_code' => 'BSCS',
       	]
       ]);
    }
}
