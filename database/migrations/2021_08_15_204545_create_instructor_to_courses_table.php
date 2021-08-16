<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorToCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_to_courses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->unsigned()->index();
            $table->bigInteger('course_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('instructor_id')->references('id')->on('instructors');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_to_courses');
    }
}
