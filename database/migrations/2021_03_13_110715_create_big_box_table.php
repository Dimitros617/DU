<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBigBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_box', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent');
            $table->string('name',50)->nullable()->default('Nový velký box');
            $table->string('description',1024)->nullable()->default('Popisek nového velkého boxu');
            $table->string('img')->default('default.png');
            $table->string('security')->nullable();
            $table->string('key')->nullable();
            $table->string('position')->nullable();
            $table->string('style')->nullable();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('big_box');
    }
}
