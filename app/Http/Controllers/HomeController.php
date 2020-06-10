<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Road;
use App\Food;
use App\Order;
use App\Order_Group;
use App\Review;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function homepage()
    {
        $restaurants = User::where('restaurant', true)->count();
        $users = User::all()->count();
        $orders = Order::all()->count();
        $popularFoods = Food::withCount('orders')->orderBy('orders_count', 'desc')->paginate(6);

        foreach($popularFoods as $popularFood){
            $popularFood['rating'] = $popularFood->restaurant->restaurantReviews->avg('rate');
        }

        return view('index', compact(['restaurants', 'users', 'orders', 'popularFoods']));
    }

    public function about()
    {
        return view('about');
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function addressCreate()
    {
        $cities = City::all();
        $roads = Road::all();
        return view('address-create', compact(['cities', 'roads']));
    }
}
