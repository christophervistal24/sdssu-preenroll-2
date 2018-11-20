<?php

use Illuminate\Database\Seeder;

class AssistantDeanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('assistant_deans')
       	  ->insert(
       	  	[
       	  		 [
	                'id_number' => '17',
	                'name' => strtolower('ENGR. JESSIE A. DEMONTANO'),
	                'education_qualification' => strtolower('MEP-EE'),
	                'position' => strtolower('ASSISTANT PROFESSOR 4') ,
	                'status' => 'permanent',
	                'mobile_number' => '+639950523688',
	                'active' => 1,
	            ]
       	  	]
        );
    }
}
