<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantDeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistant_deans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_number')->unique();
            $table->string('name');
            $table->string('education_qualification');
            $table->string('position');
            $table->enum('status', ['permanent', 'contractual']);
            $table->string('mobile_number');
            $table->integer('active')->default(1);
            $table->string('profile')->default('no_image.png');
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
        Schema::dropIfExists('assistant_deans');
    }
}
