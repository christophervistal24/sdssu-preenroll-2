<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'A admin user';
        $role_admin->save();

        $role_parent = new Role();
        $role_parent->name = 'Parent';
        $role_parent->description = 'A parent user';
        $role_parent->save();

        $role_student = new Role();
        $role_student->name = 'Student';
        $role_student->description = 'A student user';
        $role_student->save();


        $role_instructor = new Role();
        $role_instructor->name = 'Instructor';
        $role_instructor->description = 'A instructor user';
        $role_instructor->save();

        $role_instructor = new Role();
        $role_instructor->name = 'Assistant Dean';
        $role_instructor->description = 'A Assistant Dean user';
        $role_instructor->save();
    }
}
