<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('time_slot_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('timeslot_id')->unsigned()->index();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('course_id')->unsigned()->index();
            $table->bigInteger('instructor_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('timeslot_id')->references('id')->on('timeslots')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_slot_data');
    }
}
