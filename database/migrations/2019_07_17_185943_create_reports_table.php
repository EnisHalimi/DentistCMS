<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('treatment_id')->unsigned();
            $table->integer('pacient_id')->unsigned();
            $table->text('description');
            $table->text('complaint');
            $table->text('evaluation');
            $table->text('diagnosis');
            $table->foreign('pacient_id')->references('id')->on('pacients');
            $table->foreign('treatment_id')->references('id')->on('treatments');
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
        Schema::dropIfExists('reports');
    }
}
