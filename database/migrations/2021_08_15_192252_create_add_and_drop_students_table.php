<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddAndDropStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_and_drop_students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->integer('student_department_id');
            $table->integer('student_year');
            $table->integer('adding_course');
            $table->integer('adding_in_department_id');
            $table->integer('adding_class_year');
            $table->integer('adding_class_id');
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
        Schema::dropIfExists('add_and_drop_students');
    }
}
