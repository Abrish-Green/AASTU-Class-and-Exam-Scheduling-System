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
            $table->bigInteger('student_department_id')->unsigned()->index();
            $table->integer('student_year');
            $table->bigInteger('adding_course')->unsigned()->index();
            $table->bigInteger('adding_in_department_id')->unsigned()->index();
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
