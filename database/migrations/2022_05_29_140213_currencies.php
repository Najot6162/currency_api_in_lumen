<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Currencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies',function (Blueprint $table){
                $table->bigIncrements('id');
                $table->string('name',191);
                $table->string('english_name',191);
                $table->string('alphabetic_code',20);
                $table->string('digit_code',20);
                $table->string('rate',20);
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
        Schema::dropIfExists('currencies');
    }
}
