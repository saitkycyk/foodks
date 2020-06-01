<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use App\User;
use App\Food;
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

$factory->define(Review::class, function (Faker $faker) {
    return [
        'restaurant_id' => User::where('restaurant', 1)->inRandomOrder()->first()->id,
        'user_id' => User::where('restaurant', 0)->inRandomOrder()->first()->id,
        'rate' => rand(1,5),
        'review' => $faker->sentence(),
        'created_at' => now()
    ];
});
