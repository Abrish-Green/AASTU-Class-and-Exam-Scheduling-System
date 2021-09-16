<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamBlockRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_block_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room');
            $table->string('block');
            $table->integer('year');
            $table->integer('department_id');
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
        Schema::dropIfExists('exam_block_rooms');
    }
}
