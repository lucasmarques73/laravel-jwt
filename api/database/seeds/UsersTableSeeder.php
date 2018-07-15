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
        factory(\App\Entities\User::class,4)->create();
        factory(\App\Entities\User::class)->create([
            'name' => 'Lucas Marques',
            'email' => 'lucasmarques73@hotmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);
    }
}