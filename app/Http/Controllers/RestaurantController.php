<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\Order_Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{

	public function changePreferences(Request $request)
	{
		$this->authorize('isRestaurant', User::class);

		$data['works'] = $request->works;
		$preferences = auth()->user()->preferences;

		$preferences['min_order'] = $request->restaurant_min_order;
		$preferences['userName'] = $request->userName;
		$preferences['lastName'] = $request->lastName;
		$preferences['restaurantZip'] = $request->restaurantZip;
		$preferences['restaurantWeb'] = $request->restaurantWeb;

		$data['preferences'] = $preferences;

		$request->validate([
			'payment_type' => 'required|in:door,card,all'
		]);


		if($request->payment_type == 'door') {
			$data['door_payment'] = 1;
			$data['card_payment'] = 0;
		} else if($request->payment_type == 'card') {
			$data['door_payment'] = 0;
			$data['card_payment'] = 1;
		} else {
			$data['door_payment'] = 1;
			$data['card_payment'] = 1;
		}

		auth()->user()->update($data);

		return back();
	}

	public function changePassword(Request $request)
	{
		if(Hash::check($request->old_password, auth()->user()->password)){
			try{
				$newPassword = $request->validate([
					'password' => 'required|confirmed|min:8'
				]);
			} catch (\Exception $e) {
				session()->flash('password', 'Konfirmimi i fjalëkalimit është dështuar, provoni përsëri!');
				return back();
			}

			auth()->user()->update(['password' => bcrypt($newPassword['password'])]);

			session()->flash('password', 'Fjalëkalimi u ndryshua me sukses!');
			return back();
		}

		session()->flash('password', 'Fjalëkalimi nuk përputhet me fjalëkalimin e vjetër!');
		return back();
	}

	public function changeEmail(Request $request)
	{
		if($request->old_email == auth()->user()->email){
			try{
				$newEmail = $request->validate([
					'email' => 'required|confirmed|unique:App\User,email,'.auth()->user()->id.'.id'
				]);
			} catch (\Exception $e) {
				session()->flash('email', 'Emaili nuk përputhet me emailin e vjetër ose ky email është e zënë!');
				return back();
			}

			auth()->user()->update($newEmail);

			session()->flash('email', 'Emaili u ndryshua me sukses!');
			return back();
		}

		session()->flash('email', 'Emaili nuk përputhet me emailin e vjetër ose ky email është e zënë!');
		return back();
	}


	public function adminPage()
	{
		$this->authorize('isRestaurant', User::class);

		$restaurant = auth()->user();
		
		return view('admin', compact('restaurant'));
	}


	public function changeInfo(Request $request)
	{
		$data = $request->validate([
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

		$path = $request->file('file')->storeAs('public/logos', 'AccountLogo'.auth()->user()->id.'.jpg');

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
			'preferences' => [
				'userName' => $request->userName,
				'lastName' => $request->lastName,
				'restaurantWeb' => $request->restaurantWeb,
				'restaurantNr' => $request->restaurantNr,
				'restaurantZip' => $request->restaurantZip
			]
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


	public function restaurantMenu($id)
	{
		$user = User::findOrFail($id);

		if($user->restaurant){
			$restaurant = $user;
			return view('restaurant_menu', compact('restaurant'));
		}

		return back();
	}

	public function restaurantsPage()
	{
		$restaurants = User::where('restaurant', true);

		if(request()->has('city')) {

			if(request()->city == 'all') {
				$restaurants = $restaurants->paginate(10);

				return view('restaurants', compact('restaurants'));
			}

			$restaurants = $restaurants->where('city_id', request('city'))->paginate(10);

			return view('restaurants', compact('restaurants'));

		} else {
			if(auth()->user() != null) {
				$restaurants = $restaurants->where('city_id', auth()->user()->id);

				return redirect('/restaurants?city='.auth()->user()->city_id)->with('restaurants');
			}
		}

		$restaurants = $restaurants->paginate(10);
		return redirect('/restaurants?city=all')->with('restaurants');
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
