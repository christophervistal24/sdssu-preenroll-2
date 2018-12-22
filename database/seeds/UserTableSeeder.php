<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_parent = Role::where('name','Parent')->first();
        $role_admin = Role::where('name','Admin')->first();
        $role_student = Role::where('name','Student')->first();
        $role_instructor = Role::where('name','Instructor')->first();
        $role_assistant_dean = Role::where('name','Assistant Dean')->first();

        $parent = new User();
        // $parent->email ='parent@gmail.com';
        $parent->id_number = '1511111';
        $parent->password = 1234;
        $parent->save();
        $parent->roles()->attach($role_parent);

        $admin = new User();
        // $admin->email ='admin@gmail.com';
        $admin->id_number = '1522222';
        $admin->password = 1234;
        $admin->save();
        $admin->roles()->attach($role_admin);


        $student = new User();
        $student->id_number = '1533333';
        $student->password = 1234;
        $student->save();
        $student->roles()->attach($role_student);

        $instructor = new User();
        $instructor->id_number = '1544444';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '01';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '02';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '03';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '04';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '05';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '06';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '07';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '08';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '09';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '10';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '11';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '12';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '13';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '14';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '15';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        $instructor = new User();
        $instructor->id_number = '16';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

        /*ASSISTANT DEAN*/
        $instructor = new User();
        $instructor->id_number = '17';
        $instructor->password = 1234;
        $instructor->save();
        $instructor->roles()->attach($role_assistant_dean);
        /*END OF ASSISTANT DEAN*/

    }
}
