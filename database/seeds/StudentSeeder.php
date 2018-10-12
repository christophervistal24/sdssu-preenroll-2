<?php
use App\Role;
use App\Student;
use App\StudentParent;
use App\User;
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
      $parent = new StudentParent;
      $parent->mothername = 'Regina Vistal';
      $parent->fathername = 'Crisogono Vistal';
      $parent->mobile_number = '09193693499';
      $parent->save();

   		$student = new Student();
   		$student->id_number = 1501755;
   		$student->fullname = 'Christopher P. Vistal';
   		$student->year = 1;
   		$student->course_id = 2;
      $student->student_parent_id = $parent->id;
   		$student->save();

   		$s = new User();
      $s->name = 'Christopher P. Vistal';
      $s->id_number = 1501755;
      $s->password = bcrypt(1234);
      $s->save();
 		  $s->roles()->attach($role_student);

    }
}
