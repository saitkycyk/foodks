<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\City;
use App\Road;
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
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'restaurant' => $faker->boolean() ? true : false,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'city_id' => City::inRandomOrder()->first()->id,
        'road_id' => Road::inRandomOrder()->first()->id,
        'works' => "10:00-20:00",
        'preferences' => [
            'min_order' => '5',
            'description' => $faker->text
        ],
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(50),
        'created_at' => now()
    ];
});
