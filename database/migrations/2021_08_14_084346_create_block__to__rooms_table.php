<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('block__to__rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->timestamps();

           $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block__to__rooms');
    }
}
