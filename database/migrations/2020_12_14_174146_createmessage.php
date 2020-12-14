<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createmessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('message',300)->default('');
            $table->tinyInteger('priority',)->default('0');

            $table->foreign('user_id')->references('id')->on('users');

        });
    }
}
