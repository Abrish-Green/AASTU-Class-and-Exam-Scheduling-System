<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamInvigilatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_invigilators', function (Blueprint $table) {
            $table->id();
            $table->string('invigilator_name');
            $table->boolean('active')->default(1);
            $table->bigInteger('department_id')->unsigned()->index();
            $table->timestamps();

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
        Schema::dropIfExists('exam_invigilators');
    }
}
