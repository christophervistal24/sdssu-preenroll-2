<?php

use Illuminate\Database\Seeder;

class CSSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('subjects')->insert([
         	/*FIRST YEAR FIRST SEM*/
         	[
					'sub'             => 'CS 111',
					'sub_description' => 'Introduction Computing',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 112',
					'sub_description' => 'Fundamental of Programming - C++',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'GE-US',
					'sub_description' => 'Understanding the Self',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'GE-MMW',
					'sub_description' => 'Mathematics in the Modern World',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'GE-PC',
					'sub_description' => 'Purposive Communication',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'Fil 1',
					'sub_description' => 'Kontekstwalisadong Komunikasyon sa Filipino',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'IT 1',
					'sub_description' => 'Living in the IT Era',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'PE 1',
					'sub_description' => 'Physical Fitness & Health',
					'units'           => 2,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'NSTP 1',
					'sub_description' => 'National Service Training Program 1',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 1,
         	],
         	/*END OF FIRST YEAR FIRST SEM*/

         	/*START OF SECOND SEM FIRST YEAR*/
         	[
					'sub'             => 'CS 121',
					'sub_description' => 'Discrete Structures 1',
					'units'           => 3,
					'prereq'          => 'CS 112',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 122',
					'sub_description' => 'Intermediate Programming - Java Prog.',
					'units'           => 3,
					'prereq'          => 'CS 112',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 123',
					'sub_description' => 'Multimedia Systems',
					'units'           => 3,
					'prereq'          => 'CS 112',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'Fil 2',
					'sub_description' => 'Filipino sa Iba\'t-ibang Disiplina',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'GE-STS',
					'sub_description' => 'Science,Technology and Society',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'GE-E',
					'sub_description' => 'Ethics',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'GE-CW',
					'sub_description' => 'The Contemporary World',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'PE 2',
					'sub_description' => 'Rhythmic Activities',
					'units'           => 2,
					'prereq'          => '',
					'year'            => 1,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'NSTP 2',
					'sub_description' => 'National Service Training Program 2',
					'units'           => 3,
					'prereq'          => 'NSTP 1',
					'year'            => 1,
					'semester'        => 2,
         	],
         	/*END OF SECOND SEM FIRST YEAR*/

         	/*SECOND YEAR FIRST SEM*/
         	[
					'sub'             => 'CS 211',
					'sub_description' => 'Discreate Structures 2',
					'units'           => 3,
					'prereq'          => 'CS 121',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 212',
					'sub_description' => 'Object-Oriented Programming-VB.Net',
					'units'           => 3,
					'prereq'          => 'CS 122',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 213',
					'sub_description' => 'Data Structures and algorithms',
					'units'           => 3,
					'prereq'          => 'CS 122',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 214',
					'sub_description' => 'Embedded systems ',
					'units'           => 3,
					'prereq'          => 'CS 122',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'Entrep 1',
					'sub_description' => 'The Entreprenuerial Mind',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'GE-AA',
					'sub_description' => 'Art Appreciation',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'PE 3',
					'sub_description' => 'Individual and Dual Sports',
					'units'           => 2,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 1,
         	],
         	/*END OF SECOND YEAR FIRST SEM*/

         	/*START OF SECOND YEAR SECOND SEM*/
         	[
					'sub'             => 'CS 221',
					'sub_description' => 'Algorithms and complexity',
					'units'           => 3,
					'prereq'          => 'CS 213',
					'year'            => 2,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 222',
					'sub_description' => 'information management',
					'units'           => 3,
					'prereq'          => 'CS 212',
					'year'            => 2,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 223',
					'sub_description' => 'Web Systems and Technologies 1',
					'units'           => 3,
					'prereq'          => 'CS 212',
					'year'            => 2,
					'semester'        => 2,
         	],
         	//ASK
         	[
					'sub'             => 'Math-Elec',
					'sub_description' => 'Theory of Computation',
					'units'           => 3,
					'prereq'          => 'GE-MMW',
					'year'            => 2,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'Ecos 1',
					'sub_description' => 'People and the Earth\'s Ecosystem',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'GE-RPH',
					'sub_description' => 'Readings in Philippine History',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'PE 4',
					'sub_description' => 'Recreational and team Sports',
					'units'           => 2,
					'prereq'          => '',
					'year'            => 2,
					'semester'        => 2,
         	],
         	/*END OF SECOND YEAR SECOND SEM*/

         	/*START OF THIRD YEAR FIRST SEM*/
         	[
					'sub'             => 'CS 311',
					'sub_description' => 'Automata Theory and Formal Languages',
					'units'           => 3,
					'prereq'          => 'CS 221',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 312',
					'sub_description' => 'Architecture and Organization',
					'units'           => 3,
					'prereq'          => 'CS 221',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 313',
					'sub_description' => 'Information Assurance and Security',
					'units'           => 3,
					'prereq'          => 'CS 222',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 314',
					'sub_description' => 'System Fundamentals-Elective 1',
					'units'           => 3,
					'prereq'          => 'CS 222',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 315',
					'sub_description' => 'Application Dev\'t & Emerging Technologies',
					'units'           => 3,
					'prereq'          => 'CS 222',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 316',
					'sub_description' => 'Web Systems and Technologies',
					'units'           => 3,
					'prereq'          => 'CS 223',
					'year'            => 3,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'Rizal',
					'sub_description' => 'Life and Works of Rizal',
					'units'           => 3,
					'prereq'          => '',
					'year'            => 3,
					'semester'        => 1,
         	],
         	/*END OF THIRD YEAR FIRST SEM*/

         	/*START OF THIRD YEAR SECOND SEM*/
         	[
					'sub'             => 'CS 321',
					'sub_description' => 'Programming Languges',
					'units'           => 3,
					'prereq'          => 'CS 312',
					'year'            => 3,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 322',
					'sub_description' => 'Software Engineering 1',
					'units'           => 3,
					'prereq'          => 'CS 312',
					'year'            => 3,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 323',
					'sub_description' => 'Social Issues and Professional Practice 1',
					'units'           => 3,
					'prereq'          => 'CS 313',
					'year'            => 3,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 324',
					'sub_description' => 'Graphics and Visual Computing-Elective 2',
					'units'           => 3,
					'prereq'          => 'CS 316',
					'year'            => 3,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 325',
					'sub_description' => 'Mobile Computing 1',
					'units'           => 3,
					'prereq'          => 'CS 315',
					'year'            => 3,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 326',
					'sub_description' => 'Modeling and Simulation',
					'units'           => 3,
					'prereq'          => 'CS 314',
					'year'            => 3,
					'semester'        => 2,
         	],
         	/*END OF THIRD YEAR SECOND SEM*/
         	/*START OF THIRD YEAR SUMMER*/
         	[
					'sub'             => 'CS 331',
					'sub_description' => 'Practicum(162 hours)',
					'units'           => 3,
					'prereq'          => '3rd year standing',
					'year'            => 3,
					'semester'        => '',
         	],
         	/*START OF THIRD YEAR SUMMER*/

         	/*START OF FOURTH YEAR FIRST SEM*/
         	[
					'sub'             => 'CS 411',
					'sub_description' => 'Human Computer Interaction',
					'units'           => 3,
					'prereq'          => 'CS 323',
					'year'            => 4,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 412',
					'sub_description' => 'Operating Systems',
					'units'           => 3,
					'prereq'          => 'CS 321',
					'year'            => 4,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 413',
					'sub_description' => 'Software Engineering 2',
					'units'           => 3,
					'prereq'          => 'CS 322',
					'year'            => 4,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 414',
					'sub_description' => 'CS Thesis Writing 1',
					'units'           => 3,
					'prereq'          => '4th year Standing',
					'year'            => 4,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 415',
					'sub_description' => 'Intelligent Systems-Elective 3',
					'units'           => 3,
					'prereq'          => 'CS 326',
					'year'            => 4,
					'semester'        => 1,
         	],
         	[
					'sub'             => 'CS 416',
					'sub_description' => 'Mobile Computing 2',
					'units'           => 3,
					'prereq'          => 'CS 325',
					'year'            => 4,
					'semester'        => 1,
         	],
         	/*END OF FOURTH YEAR FIRST SEM*/

         	/*START OF FOURTH YEAR SECOND SEM*/
         	[
					'sub'             => 'CS 421',
					'sub_description' => 'Networking and Communications',
					'units'           => 3,
					'prereq'          => 'CS 412',
					'year'            => 4,
					'semester'        => 2,
         	],
         	[
					'sub'             => 'CS 422',
					'sub_description' => 'CS Thesis Writing 2',
					'units'           => 3,
					'prereq'          => 'CS 414',
					'year'            => 4,
					'semester'        => 2,
         	],
         	/*END OF FOURTH YEAR SECOND SEM*/

         ]);
    }
}
