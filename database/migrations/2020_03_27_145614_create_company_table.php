<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('nr_fiscal')->nullable();
            $table->string('nr_business')->nullable();
            $table->string('nr_tax')->nullable();
            $table->string('tvsh');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('adress');
            $table->string('city');
            $table->string('account_1')->nullable();
            $table->string('account_2')->nullable();
            $table->string('account_3')->nullable();
            $table->boolean('theme');
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
        Schema::dropIfExists('company');
    }
}
