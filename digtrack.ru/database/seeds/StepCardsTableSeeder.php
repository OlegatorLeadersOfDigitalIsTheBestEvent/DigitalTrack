<?php

use Illuminate\Database\Seeder;

class StepCardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 2, 3, 7, 13, 25, 26
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 2
        ]);
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 3
        ]);
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 7
        ]);
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 13
        ]);
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 25
        ]);
        DB::table('step_cards')->insert([
            'day'   => 1,
            'card'  => 26
        ]);
      
        
        // 17, 35, 36					
        // DB::table('step_cards')->insert([
        //     'day'   => 3,
        //     'card'  => 4
        // ]);
        // DB::table('step_cards')->insert([
        //     'day'   => 3,
        //     'card'  => 5
        // ]);
        DB::table('step_cards')->insert([
            'day'   => 3,
            'card'  => 18
        ]);
       
        // 21, 24
       DB::table('step_cards')->insert([
            'day'   => 4,
            'card'  => 19
        ]);
        DB::table('step_cards')->insert([
            'day'   => 4,
            'card'  => 20
        ]);
        DB::table('step_cards')->insert([
            'day'   => 4,
            'card'  => 14
        ]);
        DB::table('step_cards')->insert([
            'day'   => 4,
            'card'  => 15
        ]);	
        
        DB::table('step_cards')->insert([
            'day'   => 5,
            'card'  => 6
        ]);
        DB::table('step_cards')->insert([
            'day'   => 5,
            'card'  => 23
        ]);	
    }
}
