<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaljesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daljes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('pacient_id');
            $table->integer('bill_number');
            $table->date('deadline');
            $table->string('subject');
            $table->integer('value');
            $table->string('file');
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
        Schema::dropIfExists('daljes');
    }
}
