<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorToClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_to_classes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('class_id')->unsigned()->index();
            $table->bigInteger('instructor_to_course_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('instructor_to_course_id')->references('id')->on('instructor_to_courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instructor_to_classes');
    }
}
