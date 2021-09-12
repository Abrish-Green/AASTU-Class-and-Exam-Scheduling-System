<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('course_title');
            $table->string('course_code');
            $table->string('invigilators');
            $table->date('exam_date');
            $table->string('exam_day_name');
            $table->integer('year');
            $table->integer('section_id');
            $table->string('exam_room');
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
        Schema::dropIfExists('exam_schedules');
    }
}
