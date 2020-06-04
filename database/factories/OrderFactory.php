<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Order;
use App\Food;
use App\Order_Group;
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

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => User::where('restaurant', 0)->inRandomOrder()->first()->id,
        'restaurant_id' => User::where('restaurant', 1)->inRandomOrder()->first()->id,
        'food_id' => Food::inRandomOrder()->first()->id,
        'order_group_id' => Order_Group::inRandomOrder()->first()->id,
        'price' => (double)rand(10,50) / 10,
        'quantity' => rand(1,3),
        'created_at' => now()
    ];
});
