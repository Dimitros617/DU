<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent')->nullable();
            $table->string('name',50)->default('Nová kapitola');
            $table->string('display_name',50)->default('Kapitola');
            $table->string('type_name',50)->default('chapters');
            $table->string('description',1024)->default('Popisek nové kapitoly');
            $table->string('img')->default('/user_files/default.png');
            $table->string('security')->nullable();
            $table->string('key')->nullable();
            $table->integer('position')->nullable();
            $table->string('style')->nullable();
            $table->integer('entry_limit')->nullable();
            $table->integer('time_limit')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->timestamps();

            $table->foreign('parent')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
