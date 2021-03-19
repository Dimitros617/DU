<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('parent')->nullable()->default(0);
            $table->string('subject',50)->default('Předmět');
            $table->string('name',50)->default('Nová učebnice');
            $table->string('description',1024)->default('Popisek nové učebnice');
            $table->string('img')->default('/user_files/default.png');
            $table->string('security')->nullable();
            $table->string('key')->nullable();
            $table->string('position')->nullable();
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
        Schema::dropIfExists('books');
    }
}
