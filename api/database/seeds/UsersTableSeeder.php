<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('pt_BR');
        factory(\App\Entities\User::class,5)->create();
        factory(\App\Entities\User::class)->create([
            'name' => 'Lucas Marques',
            'email' => 'lucasmarques73@hotmail.com',
            'password' => Hash::make('secret'),
            'remember_token' => str_random(10),
            'rg' => substr($faker->creditCardNumber,0,8),
            'cpf' => str_replace(['.','-'], '', $faker->cpf),
            'gender' => 'M',
            'birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
            'avatar' => $faker->imageUrl(640, 480, 'cats'),
        ]);
    }
}
