<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

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


$factory->define(Food::class, function (Faker $faker) {
	$array = array('fastfood', 'mëngjes', 'gjellë', 'supë', 'pije të ftohta', 'pije të nxehta', 'mish', 'ëmbëlsirë', 'kryesorë', 'tjerë');
	$rand = array_rand($array);

	return [
		'user_id' => User::inRandomOrder()->first()->id,
		'name' => $faker->name,
		'description' => $faker->sentence(),
		'category' => $array[$rand],
		'price' => rand(1,99),
		'drink' => $faker->boolean() ? true : false,
		'created_at' => now()
	];
});
