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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'avatar' => 'http://via.placeholder.com/150x150',
        'phone' => $faker->phoneNumber,
        'password' => Hash::make('password'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Message::class, function (Faker $faker) {
    do{
        $from = rand(1,15);
        $to = rand(1,15);
    } while($from == $to);

    return [
        'send_to' => $to,
        'send_from' => $from,
        'content' => $faker->sentence(),
    ];
});
