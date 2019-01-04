<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(InstructorSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CSSubjectSeeder::class);
        $this->call(CESubjectSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(BlockSeeder::class);
        // $this->call(SubjectScheduleSeeder::class);
        $this->call(InstructorScheduleSeeder::class);
        $this->call(CESubjectScheduleSeeder::class);
        $this->call(CSSubjectScheduleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(AssistantDeanSeeder::class);
        // $this->call(SubjectPrerequisite::class);
        $this->call(CESubjectPreRequisites::class);
        $this->call(CSSubjectPreRequisites::class);
    }
}
