<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Road;
use App\City;
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

$factory->define(Road::class, function (Faker $faker) {
    return [
        'city_id' => City::inRandomOrder()->first()->id,
        'road_nr' => rand(1,500),
        'name' => $faker->streetName,
        'location' => $faker->streetAddress,
        'created_at' => now()
    ];
});
