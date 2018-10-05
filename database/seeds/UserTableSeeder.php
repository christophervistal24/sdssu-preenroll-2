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

        $parent = new User();
        $parent->name = 'Joshua';
        // $parent->email ='parent@gmail.com';
        $parent->id_number = '1511111';
        $parent->password = bcrypt(1234);
        $parent->save();
        $parent->roles()->attach($role_parent);

        $admin = new User();
        $admin->name = 'Villamon Admin';
        // $admin->email ='admin@gmail.com';
        $admin->id_number = '1522222';
        $admin->password = bcrypt(1234);
        $admin->save();
        $admin->roles()->attach($role_admin);


        $student = new User();
        $student->name = 'Student student';
        // $student->email ='student@gmail.com';
        $student->id_number = '1533333';
        $student->password = bcrypt(1234);
        $student->save();
        $student->roles()->attach($role_student);

        $instructor = new User();
        $instructor->name = 'Instructor Instructor';
        // $instructor->email ='instructor@gmail.com';
        $instructor->id_number = '1544444';
        $instructor->password = bcrypt(1234);
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

    }
}
