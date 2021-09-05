<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeBlockRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_block_rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('college_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('college_id')->references('id')->on('colleges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('college_block_rooms');
    }
}
