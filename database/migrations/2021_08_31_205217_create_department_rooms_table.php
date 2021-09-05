<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_rooms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned()->index();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->bigInteger('department_id')->unsigned()->index();
            $table->bigInteger('college_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('block_id')->references('id')->on('blocks');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('department_rooms');
    }
}
