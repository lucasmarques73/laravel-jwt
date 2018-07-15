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
        factory(\App\User::class,4)->create();
        factory(\App\User::class)->create([
            'name' => 'Lucas Marques',
            'email' => 'lucasmarques73@hotmail.com',
            'password' => bcrypt('secret'),
            'remember_token' => str_random(10),
        ]);
    }
}
