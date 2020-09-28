<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    $currency = ['USD', 'GBP', 'EUR'];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'hourly_rate' => rand(1, 200),
        'currency' => $currency[array_rand($currency, 1)],
    ];
});
