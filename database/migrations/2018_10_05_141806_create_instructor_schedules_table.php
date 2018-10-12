<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('days');
            $table->string('room');
            $table->string('instructor')->nullable();
            $table->string('subject');
            $table->enum('status',['delete','active'])->default('active');
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
        Schema::dropIfExists('instructor_schedules');
    }
}
