<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent');
            $table->string('type')->nullable();
            $table->string('security')->nullable();
            $table->string('key')->nullable();
            $table->string('position')->nullable();
            $table->string('style')->nullable();

            $table->string('url')->nullable();
            $table->string('name',50)->nullable()->default('Nový element');
            $table->string('description',2048)->nullable()->default('Popisek');
            $table->string('data',2048)->nullable();
            $table->string('data1',2048)->nullable();
            $table->string('data2',2048)->nullable();
            $table->string('results',2048)->nullable();


            $table->timestamps();

            $table->foreign('parent')->references('id')->on('middle_box');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('elements');
    }
}