<?php
use App\Role;
use App\Student;
use App\StudentParent;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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
   		$student->id_number = 1502108;
   		$student->fullname = 'Joshua Safico';
   		$student->year = 1;
   		$student->course_id = 2;
      $student->address = 'Awasian Tandag City';
      $student->gender = 'male';
      $student->mothername = 'Regina Safico';
      $student->fathername = 'Crisogono Safico';
      $student->mobile_number = '09193693499';
   		$student->save();

   		$s = new User();
      $s->id_number = 1502108;
      $s->password = 1234;
      $s->save();
 		  $s->roles()->attach($role_student);


      $student = new Student();
      $student->id_number = 1500507;
      $student->fullname = 'Jover Jhon Villamon';
      $student->year = 1;
      $student->course_id = 2;
      $student->address = 'Awasian Tandag City';
      $student->gender = 'male';
      $student->mothername = 'Regina Vistal';
      $student->fathername = 'Crisogono Vistal';
      $student->mobile_number = '09193693410';
      $student->save();

      $s = new User();
      $s->id_number = 1500507;
      $s->password = 1234;
      $s->save();
      $s->roles()->attach($role_student);

     /* $faker = Faker::create();
         foreach (range(10,45) as $index) {
              DB::table('students')->insert([
                  'id_number' => '15017' . $index,
                  'fullname' => $faker->name,
                  'year' => 1,
                  'course_id' => 2,
                  'student_parent_id' => $parent->id,
              ]);
       }

       foreach (range(10,45) as $index) {
              DB::table('student_parents')->insert([
                  'mothername' => $faker->name,
                  'fathername' => $faker->name,
                  'mobile_number' => '09193693499',
             ]);
       }*/
    }
}
