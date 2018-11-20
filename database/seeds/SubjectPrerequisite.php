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
		
    }
}
