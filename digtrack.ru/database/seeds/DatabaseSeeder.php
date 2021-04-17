<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->call(CardsList::class);
        $this->call(CardTypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PrivateNewsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(StepCardsTableSeeder::class);
        
        
    }
}
