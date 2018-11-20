<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')
       	  ->insert(
       	  	[
       	  		 [
	                'id_number' => '1522222',
	                'name' => 'Adminstrator Admin',
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
