<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->unsigned()->index();
            $table->bigInteger('instructor_office_position_id')->unsigned()->index();
            $table->bigInteger('instructor_taught_courses_id')->unsigned()->index();
            $table->integer('semester');
            $table->integer('year');
            $table->bigInteger('class_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('instructor_office_position_id')->references('id')->on('office_positions');
            $table->foreign('instructor_taught_courses_id')->references('id')->on('courses');
            $table->foreign('instructor_id')->references('id')->on('courses');
            $table->foreign('class_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_profiles');
    }
}
