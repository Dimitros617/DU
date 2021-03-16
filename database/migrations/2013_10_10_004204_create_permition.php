<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreatePermition extends Migration
{
    public function up()
    {
        Schema::create('permition', function (Blueprint $table) {

            $table->id();
            $table->string('name',40);
            $table->tinyInteger('default',)->default('0');
            $table->tinyInteger('possibility_read',)->default('0');
            $table->tinyInteger('new_user',)->default('0');
            $table->tinyInteger('edit_content',)->default('0');
            $table->tinyInteger('edit_permitions',)->default('0');



        });
    }
}
