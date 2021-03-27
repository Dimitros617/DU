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
            $table->unsignedBigInteger('type');
            $table->string('security')->nullable();
            $table->string('key')->nullable();
            $table->string('position')->nullable();
            $table->string('style')->nullable();

            $table->string('url')->nullable();
            $table->string('name',50)->nullable()->default('Nový element');
            $table->string('description',2048)->nullable()->default('Popisek');
            $table->json('data_json')->nullable();
            $table->string('data',4096)->nullable();
            $table->string('data1',2048)->nullable();
            $table->string('data2',2048)->nullable();
            $table->string('correct',2048)->nullable();
            $table->json('correct_json')->nullable();


            $table->timestamps();

            $table->foreign('parent')->references('id')->on('middle_box');
            $table->foreign('type')->references('id')->on('element_types');
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
