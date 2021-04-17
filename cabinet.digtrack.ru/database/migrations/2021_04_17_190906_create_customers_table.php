<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('department_id')->nullable();
            $table->integer('position_id');

            $table->string('first_name');
            $table->string('second_name');
            $table->string('last_name');

            $table->string('email_home')->nullable();
            $table->string('email_work');

            // Номера телефонов
            $table->string('personal_phone_number')->nullable();
            $table->string('work_phone_number')->nullable();

            // Номера телефоном для телеги и васапа
            $table->string('whatsapp_number')->nullable();
            $table->string('telegram_number')->nullable();
            // Никнейм телеги
            $table->string('telegram_username')->nullable();
            // Страница в ВК id ()
            $table->string('vk_id')->nullable();
        
            $table->boolean('left')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
