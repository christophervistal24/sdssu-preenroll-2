<?php

use App\Subject;
use App\SubjectPreRequisite as sub_pre;
use Illuminate\Database\Seeder;

class CSSubjectPreRequisites extends Seeder
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
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 112' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 123'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 112' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Fil 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Fil 1' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'NSTP 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'NSTP 1' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 211'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 121' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 212'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 213'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 214'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 122' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 221'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 213' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 222'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 212' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 223'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 212' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Math-Elec'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE-MMW' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 311'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 221' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 312'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 221' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 313'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 314'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 315'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 222' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 316'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 223' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 321'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 312' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 322'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 312' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 323'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 313' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 324'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 316' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 325'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 315' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 326'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 314' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 331'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => '3rd year standing' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 411'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 323' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 412'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 321' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 413'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 322' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 414'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => '4th year Standing' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 415'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 326' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 416'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 325' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 421'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 412' ,'course' => 2,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'CS 422'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CS 414' ,'course' => 2,]);
        $s->pre_req()->save($p);
        // END OF CS SUBJECT PRE-REQUISITE


    }
}
