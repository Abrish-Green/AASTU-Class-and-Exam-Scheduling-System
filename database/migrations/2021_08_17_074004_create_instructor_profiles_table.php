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
            $table->integer('instructor_id');
            $table->integer('instructor_office_position_id');
            $table->integer('instructor_taught_courses_id');
            $table->integer('semester');
            $table->integer('year');
            $table->integer('class_id');
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
        Schema::dropIfExists('instructor_profiles');
    }
}
