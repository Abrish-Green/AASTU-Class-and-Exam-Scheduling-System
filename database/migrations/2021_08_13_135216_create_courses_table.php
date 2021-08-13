<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_title');
            $table->integer('year');
            $table->string('course_code');
            $table->integer('course_credit_hour');
            $table->boolean('course_has_lab');
            $table->enum('course_type',['Common_course','Major_course','Supporting_course']);
            $table->bigInteger('course_department_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('course_department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
