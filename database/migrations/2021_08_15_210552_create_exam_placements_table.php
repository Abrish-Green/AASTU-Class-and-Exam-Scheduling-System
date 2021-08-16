<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamPlacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_placements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('section_id')->unsigned()->index();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('section_id')->references('id')->on('exam_class_sections');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_placements');
    }
}
