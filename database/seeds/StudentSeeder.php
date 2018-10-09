<?php
use App\Role;
use App\User;
use App\Student;

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_student = Role::where('name','Student')->first();

   		$student = new Student();
   		$student->id_number = 1501755;
   		$student->fullname = 'Christopher P. Vistal';
   		$student->year = 1;
   		$student->course_id = 2;
   		$student->save();

   		$s = new User();
      $s->name = 'Christopher P. Vistal';
      $s->id_number = 1501755;
      $s->password = bcrypt(1234);
      $s->save();
 		  $s->roles()->attach($role_student);

    }
}
