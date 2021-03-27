<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('element_types', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->default('Nový typ elementu');
            $table->string('blade',2048)->default('default_element');
            $table->string('svg',512)->default('default_element.svg');
            $table->string('data')->nullable();
            $table->json('data_json')->nullable();
            $table->string('correct',512)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('element_types');
    }
}
