<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_number');
            $table->string('fullname');
            $table->string('address');
            $table->enum('gender',['male','female']);
            $table->integer('year');
            $table->integer('course_id');
            $table->string('block')->nullable();
            $table->string('mobile_number')->nullable();
            $table->integer('student_parent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
