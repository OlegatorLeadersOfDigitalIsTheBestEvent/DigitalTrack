<?php

use Illuminate\Database\Seeder;

class ScriptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scripts')->insert([
            'name' => 'Корпорация',
            'price' => 1000,
            
        ]);
        DB::table('scripts')->insert([
            'name' => 'Персональная безопасность',
            'price' => 1000,
        ]);
        
    }
}
