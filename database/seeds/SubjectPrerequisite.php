<?php

use Illuminate\Database\Seeder;
use App\SubjectPreRequisite as sub_pre;
use App\Subject;

class SubjectPrerequisite extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// CS SUBJECT PRE-REQUISITE
		$s = Subject::where('sub','CS 121')->firstOrFail();
		$pre = new sub_pre(['subject_id' => $s->id, 'pre_requisite_code' => 'CS 112']);
		$s->pre_req()->save($pre);

		$s = Subject::where(['sub'=> 'CS 122'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 112']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 123'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 112']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'NSTP 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'NSTP 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 211'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 121']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 212'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 213'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 214'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 221'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 213']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 222'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 212']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 223'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 212']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Math-Elec'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE-MMW']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 311'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 221']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 312'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 221']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 313'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 314'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 315'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 316'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 223']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 321'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 312']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 322'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 312']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 323'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 313']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 324'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 316']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 325'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 315']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 326'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 314']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 331'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => '3rd year standing']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 411'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 323']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 412'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 321']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 413'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 322']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 414'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => '4th year Standing']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 415'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 326']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 416'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 325']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 421'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 412']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'CS 422'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 414']);
		$s->pre_req()->save($p);
		// END OF CS SUBJECT PRE-REQUISITE


		// CE SUBJECT PRE-REQUISITE
		//
		//1ST YEAR SECOND SEMESTER
		$s = Subject::where(['sub'=> 'Chem 16'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Eng 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Math 51'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'NSTP 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'NSTP 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'PE 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Phys 21'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3']);
		$s->pre_req()->save($p);

		//2ND YEAR FIRST SEMESTER
		$s = Subject::where(['sub'=> 'Eng 3'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 2']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Math 61'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 51']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'PE 3'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 2']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Phys 31'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 21']);
		$s->pre_req()->save($p);

		//2ND YEAR SECOND SEMESTER
		$s = Subject::where(['sub'=> 'ES 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'ES 40'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Fil 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Fil 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Fil 2'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Fil 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Math 71'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 61']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'PE 4'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 3']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'Phys 41'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 31']);
		$s->pre_req()->save($p);


		//3RD YEAR FIRST SEMESTER
		$s = Subject::where(['sub'=> 'ES 51'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 71']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'ES 61'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 71']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 21']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'ES 71'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'GE 41'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub'=> 'ME 151'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 41']);
		$s->pre_req()->save($p);


		//3RD YEAR SECOND SEMESTER
		$s = Subject::where(['sub' => 'CE 100'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'EE 123'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 31']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'Eng 4'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 2']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'ES 55'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 51']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 40']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'ES 62'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 61']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'ES 64'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 61']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'GE 42'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE 41']);
		$s->pre_req()->save($p);

		//4TH YEAR FIRST SEMESTER
		$s = Subject::where(['sub' => 'CE 101'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 111'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 1']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 120'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE 42']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 140'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 64']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 141'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 64']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'ES 65'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 62']);
		$s->pre_req()->save($p);

		//4TH YEAR SECOND SEMESTER
		$s = Subject::where(['sub' => 'CE 102'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 65']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 101']);
		$s->pre_req()->save($p);


		$s = Subject::where(['sub' => 'CE 112'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 111']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 121'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 120']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 142'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 141']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 144'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 141']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 150'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40']);
		$s->pre_req()->save($p);
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 65']);
		$s->pre_req()->save($p);


		$s = Subject::where(['sub' => 'ES 56'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 51']);
		$s->pre_req()->save($p);

		//5TH YEAR FIRST SEMESTER
		$s = Subject::where(['sub' => 'CE 145'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 144']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 147'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 142']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 151'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 150']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 181'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 120']);
		$s->pre_req()->save($p);

		//5TH YEAR SECOND SEMESTER
		$s = Subject::where(['sub' => 'CE 103'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 102']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'CE 183'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 121']);
		$s->pre_req()->save($p);

		$s = Subject::where(['sub' => 'ES 91'])->firstOrFail();
		$p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 90']);
		$s->pre_req()->save($p);












		// END OF CE SUBJECT PRE-REQUISITE

    }
}
