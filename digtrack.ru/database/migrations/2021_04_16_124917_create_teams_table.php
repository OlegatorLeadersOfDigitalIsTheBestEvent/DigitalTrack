<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('team_number');

            $table->string('key')->unique();
            $table->string('type')->nullable();
            $table->integer('company')->nullable();
            $table->string('key_issuing_email')->nullable();

            $table->string('name');
            $table->string('surname');
            // $table->string('lang');
            
            $table->integer('score')->default(0);
            $table->integer('key_usage_count')->default(0);
            // самый большой ход
            $table->integer('max_step')->default(0);
            
            $table->integer('used');
            /* Можно использовать только в логике выдачи новых ключей*/
            $table->boolean('issuance')->default(false); // выдан ли ключ, если выдан новый выдавать нельзя
            $table->timestamp('used_time')->nullable()->default(null);
            $table->boolean('ingame')->default(false);

            $table->integer('step1');
            $table->integer('step1_user_result')->nullable()->default(0);
            $table->integer('step1_max_result')->nullable()->default(0);
            $table->integer('step2');
            $table->integer('step2_user_result')->nullable()->default(0);
            $table->integer('step2_max_result')->nullable()->default(0);
            $table->integer('step3');
            $table->integer('step3_user_result')->nullable()->default(0);
            $table->integer('step3_max_result')->nullable()->default(0);
            $table->integer('step4');
            $table->integer('step4_user_result')->nullable()->default(0);
            $table->integer('step4_max_result')->nullable()->default(0);
            $table->integer('step5');
            $table->integer('step5_user_result')->nullable()->default(0);
            $table->integer('step5_max_result')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
