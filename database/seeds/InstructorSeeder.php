<?php

use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
			[
                'id_number' => '1',
				'name' => strtolower('ERLINDA M. RAVELO'),
				'education_qualification' => strtolower('MST-HE'),
				'position' => strtolower('ASSISTANT PROFESSOR 1'),
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '2',
                'name' => strtolower('ENGR. ERNESTO R. CUARTERO,'),
                'education_qualification' => strtolower('MAT-Math'),
                'position' => strtolower('ASSISTANT PROFESSOR 1') ,
                'status' => 'permanent',
				'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '3',
                'name' => strtolower('NAP NICHOLE GREG S. SALERA'),
                'education_qualification' => strtolower('MSCS'),
                'position' => strtolower('Instructor 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '4',
                'name' => strtolower('ENGR. JESSIE A. DEMONTANO'),
                'education_qualification' => strtolower('MEP-EE'),
                'position' => strtolower('ASSISTANT PROFESSOR 4') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '5',
                'name' => strtolower('CATHERINE R. ALIMBOYONG'),
                'education_qualification' => strtolower('MIT'),
                'position' => strtolower('ASSISTANT PROFESSOR 2') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '6',
                'name' => strtolower('CHERLY B. SARDOVIA'),
                'education_qualification' => strtolower('MSCS'),
                'position' => strtolower('INSTRUCTOR 1'),
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '7',
                'name' => strtolower('ENGR. ALEX S. LADAGA'),
                'education_qualification' => strtolower('Ph.D'),
                'position' => strtolower('CECST DEAN/ASSO. PROFESSOR 2') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '8',
                'name' => strtolower('ENGR. RETCHE G. TUBAY'),
                'education_qualification' => strtolower('MEPCE'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '9',
                'name' => strtolower('ENGR. REMEGIO P. DAPANAS'),
                'education_qualification' => strtolower('MSAMS'),
                'position' => strtolower('ASSISTANT PROFESSOR 4') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '10',
                'name' => strtolower('JOSEPHINE L. BULILAN'),
                'education_qualification' => strtolower('MIT'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '11',
                'name' => strtolower('MARY ANN F. GUIRAL ESTAL'),
                'education_qualification' => strtolower('MST'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '12',
                'name' => strtolower('MICHAEL L. ESTAL'),
                'education_qualification' => strtolower('MSCS'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '13',
                'name' => strtolower('LOLITA A. CLIMACO VICENTE'),
                'education_qualification' => strtolower('MSMATH'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '14',
                'name' => strtolower('SHIELLA ANN B. PACHECO'),
                'education_qualification' => strtolower('MSCS'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '15',
                'name' => strtolower('MELBRICK A. EVALLAR'),
                'education_qualification' => strtolower('MSCS'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '16',
                'name' => strtolower('BORN CHRISTIAN A. ISIP'),
                'education_qualification' => strtolower('DTE'),
                'position' => strtolower('ASSISTANT PROFESSOR 4') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
            [
                'id_number' => '17',
                'name' => strtolower('ENGR. DIVINE GRACE N. LOREN'),
                'education_qualification' => strtolower('MIT'),
                'position' => strtolower('INSTRUCTOR 1') ,
                'status' => 'permanent',
                'mobile_number' => '+639950523688',
                'active' => 1,
            ],
       	]);
    }
}
