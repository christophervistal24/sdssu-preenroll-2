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
        $parent->name = 'Christopher';
        $parent->email ='christophervistal24@gmail.com';
        $parent->password = bcrypt(1234);
        $parent->save();
        $parent->roles()->attach($role_parent);

        $admin = new User();
        $admin->name = 'Christopher2';
        $admin->email ='christophervistal2@gmail.com';
        $admin->password = bcrypt(1234);
        $admin->save();
        $admin->roles()->attach($role_admin);


        $student = new User();
        $student->name = 'Christopher3';
        $student->email ='christophervistal3@gmail.com';
        $student->password = bcrypt(1234);
        $student->save();
        $student->roles()->attach($role_student);

        $instructor = new User();
        $instructor->name = 'Christopher4';
        $instructor->email ='christophervistal4@gmail.com';
        $instructor->password = bcrypt(1234);
        $instructor->save();
        $instructor->roles()->attach($role_instructor);

    }
}
