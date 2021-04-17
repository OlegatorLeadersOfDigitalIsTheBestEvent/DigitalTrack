<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'     => 'Олег',
            'surname'     => 'Бахтадзе-Карнаухов',
            'lastname'     => 'Георгиевич',
            'email'    => 'oleg@cyber-training.ru',
            'password' => bcrypt('kirill11'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Лев',
            'surname'     => 'Аванесов',
            'lastname'     => 'Эдуардович',
            'email'    => 'lev@cyber-training.ru',
            'password' => bcrypt('lev_genius_2010_doc'),
        ]);
    }
}
