<?php

use App\Subject;
use Illuminate\Database\Seeder;
use App\SubjectPreRequisite as sub_pre;

class CESubjectPreRequisites extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // CE SUBJECT PRE-REQUISITE
        //
        //1ST YEAR SECOND SEMESTER
        $s = Subject::where(['sub'=> 'Chem 16'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Eng 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Math 51'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'NSTP 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'NSTP 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'PE 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Phys 21'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //2ND YEAR FIRST SEMESTER
        $s = Subject::where(['sub'=> 'Eng 3'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 2' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Math 61'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 51' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'PE 3'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 2' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Phys 31'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 21' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //2ND YEAR SECOND SEMESTER
        $s = Subject::where(['sub'=> 'ES 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'ES 40'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Fil 2'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Fil 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Math 71'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 61' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'PE 4'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'PE 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'Phys 41'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 31' ,'course' => 1,]);
        $s->pre_req()->save($p);


        //3RD YEAR FIRST SEMESTER
        $s = Subject::where(['sub'=> 'ES 51'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 71' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'ES 61'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 71' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 21' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'ES 71'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'GE 41'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 17' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Math 3' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub'=> 'ME 151'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 41' ,'course' => 1,]);
        $s->pre_req()->save($p);


        //3RD YEAR SECOND SEMESTER
        $s = Subject::where(['sub' => 'CE 100'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'EE 123'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Phys 31' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'Eng 4'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Eng 2' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'ES 55'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 51' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 40' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'ES 62'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 61' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'ES 64'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 61' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'GE 42'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE 41' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //4TH YEAR FIRST SEMESTER
        $s = Subject::where(['sub' => 'CE 101'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 111'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 1' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 120'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'GE 42' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 140'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 64' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 141'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 64' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'ES 65'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 62' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //4TH YEAR SECOND SEMESTER
        $s = Subject::where(['sub' => 'CE 102'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 65' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 101' ,'course' => 1,]);
        $s->pre_req()->save($p);


        $s = Subject::where(['sub' => 'CE 112'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 111' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 121'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 120' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 142'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 141' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 144'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 141' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 150'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'Geol 40' ,'course' => 1,]);
        $s->pre_req()->save($p);
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 65' ,'course' => 1,]);
        $s->pre_req()->save($p);


        $s = Subject::where(['sub' => 'ES 56'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 51' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //5TH YEAR FIRST SEMESTER
        $s = Subject::where(['sub' => 'CE 145'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 144' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 147'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 142' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 151'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 150' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 181'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 120' ,'course' => 1,]);
        $s->pre_req()->save($p);

        //5TH YEAR SECOND SEMESTER
        $s = Subject::where(['sub' => 'CE 103'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 102' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'CE 183'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'CE 121' ,'course' => 1,]);
        $s->pre_req()->save($p);

        $s = Subject::where(['sub' => 'ES 91'])->firstOrFail();
        $p = new sub_pre(['subject_id' => $s->id , 'pre_requisite_code' => 'ES 90' ,'course' => 1,]);
        $s->pre_req()->save($p);












        // END OF CE SUBJECT PRE-REQUISITE

    }
}
