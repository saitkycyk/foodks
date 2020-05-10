<?php

namespace App\Http\Controllers;

use App\Order;
use App\Order_Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{

	public function adminPage()
	{
		$this->authorize('isRestaurant', User::class);

		$restaurant = auth()->user();
		
		return view('admin', compact('restaurant'));
	}


	public function changeInfo(Request $request)
	{
		$data = $request->validate([
			'email' => 'required|unique:App\User,email,'.auth()->user()->id.'.id',
			'phone' => 'required',
			'name' => 'required',
		]);

		$preferences = auth()->user()->preferences;
		$preferences['description'] = $request->restaurant_description;
		$data['preferences'] = $preferences;

		auth()->user()->update($data);

		return back();
	}


	public function changeLogo(Request $request)
	{
		$request->validate([
			'file' => 'required|mimes:jpeg,bmp,png,svg'
		]);

		$path = $request->file('file')->storeAs('public/logos', 'RestaurantLogo'.auth()->user()->id.'.jpg');

		auth()->user()->update(['picture' => $path]);

		return back();
	}


	public function changeAddress(Request $request)
	{
		$data = $request->validate([
			'city_id' => 'required',
			'road_id' => 'required',
			'address' => 'sometimes',
		]);

		auth()->user()->update($data);

		return back();
	}


	public function create()
	{
		return view('submit_restaurant');
	}


	public function store(Request $request)
	{
		$data = $request->validate([
			'email' => 'required|unique:App\User,email',
			'password' => 'required|confirmed',
			'phone' => 'required',
			'city_id' => 'required',
			'road_id' => 'required',
			'name' => 'required'
		]);

		$data += [
			'restaurant' => 1,
			'preferences' => json_encode([
				'userName' => $request->userName,
				'lastName' => $request->lastName,
				'restaurantWeb' => $request->restaurantWeb,
				'restaurantNr' => $request->restaurantNr,
				'restaurantZip' => $request->restaurantZip
			])
		];

		$data['password'] = bcrypt($data['password']);

		$user = User::create($data);

		Auth::logout();
		Auth::login($user);

		return redirect()->route('adminPage');
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
