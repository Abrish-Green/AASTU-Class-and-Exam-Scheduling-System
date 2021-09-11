<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeparmentExamRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_exam_rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();

            $table->timestamps();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_exam_rooms');
    }
}
