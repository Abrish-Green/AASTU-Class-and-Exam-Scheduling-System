<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinalClassSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_class_schedules', function (Blueprint $table) {

            $table->id();
            $table->integer('class_id');
            $table->string('course_id');
            $table->string('course_code');
            $table->string('course_title');
            $table->string('course_credit_hour');
            $table->string('session');
            $table->string('room');
            $table->string('block');
            $table->string('day');
            $table->string('class_name');
            $table->string('semester');
            $table->string('year');
            $table->boolean('has_lab');
            $table->string('lab_name');
            $table->string('lab_id');
            $table->string('instructor');
            $table->integer('instructor_id');
            $table->string('department_name');
            $table->string('etw');
            $table->string('college_name');
            $table->string('department_id');
            $table->string('college_id');
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
        Schema::dropIfExists('final_class_schedules');
    }
}
