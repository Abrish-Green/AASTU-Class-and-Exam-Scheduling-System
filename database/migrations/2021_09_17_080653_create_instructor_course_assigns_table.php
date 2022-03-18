<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorCourseAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_course_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('instructor_id');
            $table->string('instructor_name');
            $table->string('course_id');
            $table->integer('year');
            $table->integer('semester');
            $table->integer('department_id');
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
        Schema::dropIfExists('instructor_course_assigns');
    }
}
