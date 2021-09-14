<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_exams', function (Blueprint $table) {
            $table->id();
            $table->boolean('flag')->default(false);
            $table->integer('course_id');
            $table->string('invigilator_1');
            $table->string('session');
            $table->string('room');
            $table->string('block');
            $table->string('exam_date');
            $table->string('day');
            $table->string('course_title');
            $table->string('course_code');
            $table->integer('class_id');
            $table->integer('college_id');
            $table->integer('department_id');
            $table->string('class_name');
            $table->string('invigilator_2');
            $table->string('college_name');
            $table->integer('year');

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
        Schema::dropIfExists('final_exams');
    }
}
