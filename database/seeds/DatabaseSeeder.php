<?php

use App\User;
use App\City;
use App\Road;
use App\Food;
use App\Order;
use App\Order_Group;
use App\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create();
        $this->call(CitySeeder::class);
        factory(Road::class, 300)->create();
        factory(Food::class, 200)->create();
        factory(Order_Group::class, 30)->create();
        factory(Order::class, 150)->create();
        factory(Review::class, 50)->create();
    }
}
