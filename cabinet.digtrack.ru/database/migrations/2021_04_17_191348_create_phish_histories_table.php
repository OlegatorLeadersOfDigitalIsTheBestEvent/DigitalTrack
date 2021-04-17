<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhishHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Таблица с информацией об открытых 
        Schema::create('phish_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('template_id');
            // Добавить площадку отправления
            $table->timestamp('send_time');
            $table->integer('hash_verification');
            $table->boolean('seduced')->default(false);
            $table->timestamp('open_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phish_histories');
    }
}
