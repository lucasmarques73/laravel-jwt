<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Entities\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('secret'),
        'remember_token' => str_random(10),
		'rg' => substr($faker->creditCardNumber,0,8),
		'cpf' => str_replace(['.','-'], '', $faker->cpf),
		'gender' => substr(str_shuffle('MF'), 0,1),
		'birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
		'avatar' => $faker->imageUrl(640, 480, 'cats'),
    ];
});
