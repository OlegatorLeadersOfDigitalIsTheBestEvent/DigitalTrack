<?php

use Illuminate\Database\Seeder;

class CardTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('card_types')->insert([
            'type'       => "reuse",
            'name'       => "Многоразовая",
        ]);
        DB::table('card_types')->insert([
            'type'       => "use",
            'name'       => "Одноразовая",
        ]);
    }
}
