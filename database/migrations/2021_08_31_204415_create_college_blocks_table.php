<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_blocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id')->unsigned()->index();
            $table->bigInteger('college_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('block_id')->references('id')->on('blocks');
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
        Schema::dropIfExists('college_blocks');
    }
}
