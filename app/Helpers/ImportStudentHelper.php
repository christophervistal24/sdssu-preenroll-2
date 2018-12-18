<?php
namespace App\Helpers;
use App\Course;
use App\Student;
use App\Helpers\CSVUtilities;
use App\Role;
use App\StudentParent;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laracsv\Export;
use PDO;


class ImportStudentHelper {

    private $db , $query;
    private $paths , $user_last_record , $user , $csv;
    private $parent_records;



    public function __construct(array $dsn = [] , User $user)
    {
        $this->paths  = [
            'STUDENTS_PATH' =>  base_path('storage/app/csv/students.csv'),
            'ROLES_PATH'    =>  base_path('storage/app/csv/roles.csv'),
            'PARENTS_PATH'  =>  base_path('storage/app/csv/parents.csv'),
        ];
        $this->db = new PDO("mysql:host=$dsn[host];dbname=$dsn[db_name];",$dsn['db_username'],$dsn['db_password'], [PDO::MYSQL_ATTR_LOCAL_INFILE => true]);
        $this->user = $user;
        $this->csv = new Export();
    }

    public function insertStudentParents()
    {
        $this->db->exec( //insert new parents to table parents
            sprintf("
                LOAD DATA local INFILE '%s' INTO TABLE student_parents
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\r\n' IGNORE 1 LINES
                (@id_number,@fullname,@address,@gender,@year,@course_id,@block,@mobile_number,@mothername,
                @fathername,@parent_mobile_number)
                SET mothername = @mothername , fathername=@fathername , mobile_number = @parent_mobile_number",
                 addslashes($this->paths['PARENTS_PATH']))
        );
        return $this;
    }


    public function insertStudents()
    {
        $s = $this->db->exec( //insert new students to table students
            sprintf("
                LOAD DATA local INFILE '%s' INTO TABLE students
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\r\n' IGNORE 1 LINES
                (id_number,fullname,address,gender,year,@course_id,block,mobile_number)
                 SET course_id = (SELECT id FROM courses WHERE course_code = @course_id)",
                 addslashes($this->paths['STUDENTS_PATH']))
        );
        return $this;
    }

    public function insertUsers()
    {
        //get the last record of the user before adding new users
        $this->user_last_record = (int) $this->user->getLastRecord();
        $this->db->exec(   //insert new users to table users
          sprintf("
                LOAD DATA local INFILE '%s' INTO TABLE users
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\r\n' IGNORE 1 LINES
                (id_number,password) SET password = '".bcrypt(1234)."'
                ", addslashes($this->paths['STUDENTS_PATH']))
        );
        return $this;
    }

    public function insertRoles()
    {
        //set values
        $this->csv->records   = $this->user->getRecordsAfterLast($this->user_last_record);
        $this->csv->addNewProperty($this->csv,'role_id','3');  //add new properties for csv
        //build the csv with the new property
        $csv = ($this->csv->build($this->csv->records, ['id','role_id']))->getCsv();
        file_put_contents($this->paths['ROLES_PATH'],(string) $csv); //put new content roles.csv
        $this->db->exec( //insert student role for new users
            sprintf("
                LOAD DATA local INFILE '%s' INTO TABLE user_role
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n' IGNORE 1 LINES
                (user_id,role_id)",addslashes($this->paths['ROLES_PATH'])
            )
        );

    }


}

?>