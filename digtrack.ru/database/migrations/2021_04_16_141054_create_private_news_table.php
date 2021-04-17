<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('private_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('day');
            
            $table->integer('type');

            $table->text('news_ru');
            $table->text('description_ru')->nullable();

            // видно лишь для некоторых видов карт, если - 0 видно для всех, если не 0, то для определенной карты
            $table->integer('visible')->default(0);

            

            // флаг сигнализирующий о том, что потери после дня активации, в случае плохих ходов повторяются
            $table->boolean('daily_losses')->default(0);

            $table->string('solution')->nullable();
            $table->boolean('just_today')->default(0); // для одноразовых карт, флаг означает что решение работает только если применено сегодня
            $table->string('outcomes_good')->nullable();
            $table->string('outcomes_bad')->nullable();
            $table->integer('cash_loss')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('private_news');
    }
}
