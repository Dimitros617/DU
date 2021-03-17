<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('element_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('element_id')->references('id')->on('elements');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished');
    }
}
