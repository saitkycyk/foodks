<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order_Group;
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

$factory->define(Order_Group::class, function (Faker $faker) {
	$status = ['pending', 'accepted', 'onway', 'canceled', 'delivered'];

    return [
        'user_id' => User::where('restaurant', 0)->inRandomOrder()->first()->id,
        'restaurant_id' => User::where('restaurant', 1)->inRandomOrder()->first()->id,
        'payment_type' => $faker->boolean() ? 'door' : 'card',
        'status' => $status[array_rand($status)],
        'created_at' => now()
    ];
});
