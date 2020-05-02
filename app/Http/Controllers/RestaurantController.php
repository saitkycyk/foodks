<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Order_Group;
use App\User;
use App\Order;

class RestaurantController extends Controller
{
	public function create()
	{
		return view('submit_restaurant');
	}


	public function adminPage()
	{
		$this->authorize('isRestaurant', User::class);
		return view('admin');
	}

	//split into active and finished sectors at front
	public function showOrders()
	{
		return Order_Group::all();
	}


	public function restaurantProfile(User $id)
	{
		if($id->restaurant){

			$restaurant = $id;
			return view('restaurant_profile', compact('restaurant'));
		}
	}


	public function restaurantMenu(User $id)
	{
		if($id->restaurant){
			$restaurant = $id;
			return view('restaurant_menu', compact('restaurant'));
		}

		return back();
	}

	public function restaurantsPage()
	{
		$restaurants = User::where('restaurant', true)->paginate(10);
		return view('restaurants', compact('restaurants'));
	}

	public function denyOrder(Order_Group $order_group)
	{
		$this->authorize('isOrdersFoodOwner', $order_group);

		$order_group->status = 'denied';
		$order_group->save();

		return back();
	}

	public function acceptOrder(Order_Group $order_group)
	{
		$this->authorize('isOrdersFoodOwner', $order_group);

		$order_group->status = 'accepted';
		$order_group->save();

		return back();
	}

	public function finishOrder(Order_Group $order_group)
	{
		$this->authorize('isOrdersFoodOwner', $order_group);

		$order_group->status = 'finished';
		$order_group->save();

		return back();
	}
}
