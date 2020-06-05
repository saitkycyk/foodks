<?php

namespace App\Http\Controllers;

use App\Food;
use App\Order;
use App\Order_Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{
	public function finishPayment($orderGroup, Request $request)
	{
		$orderGroup = Order_Group::findOrFail($orderGroup);

		$this->authorize('isOrderGroupOwner', $orderGroup);

		$orders = Order::whereNull('order_group_id')->get();
		abort_if($orders->isEmpty(), 404);

		$restaurant = $orderGroup->restaurant;

		$request->validate([
			'payment_method' => 'required'
		]);

		foreach($orders as $order) {

			$order->order_group_id = $orderGroup->id;
			$order->save();
		}

		$orderGroup->payment_type = $request->payment_method;
		$orderGroup->status = 'pending';
		$orderGroup->save();

		return view('order-review', compact('orders'));
	}


	public function orderPaymentPage($orderGroup)
	{
		$orderGroup = Order_Group::findOrFail($orderGroup);

		$this->authorize('isOrderGroupOwner', $orderGroup);

		$restaurant = $orderGroup->restaurant;

		return view('order-payment', compact(['restaurant', 'orderGroup']));
	}


	public function storeCheckout($id, Request $request)
	{
		$restaurant = User::findOrFail($id);

		$data = $request->validate([
			'phone' => 'required',
			'address' => 'required',
		]);

		auth()->user()->update($data);

		$orderGroup = Order_Group::create([
			'user_id' => auth()->user()->id,
			'restaurant_id' => $restaurant->id,
			'status' => "unfinished",
			'note' => $request->note
		]);

		return view('order-payment', compact(['orderGroup', 'restaurant']));
	}


	public function orderDetailPage($restaurant)
	{
		abort_if(auth()->user()->cart->isEmpty(), 404);

		$restaurant = User::findOrFail($restaurant);

		return view('order-details', compact('restaurant'));
	}


	public function delete($order)
	{
		$order = Order::findOrFail($order);

		$this->authorize('isOrderOwner', $order);

		$order->delete();

		return back();
	}


	public function store($food, Request $request)
	{
		$food = Food::findOrFail($food);

		$price = 0;
		$quantity = 1;

		if($request->ingredients != null){
			$foodIngredients = json_decode($food->ingredients, true);

			$ingredients = [];
			foreach($request->ingredients ?? [] as $key => $ingredient) {
				array_push($ingredients, $foodIngredients[$key]);
				$price += (double)$foodIngredients[$key]['ingPrice'];
			}
		}

		$price += (double)$food->price;
		$quantity = $request->quantity ?? 1;

		$order = Order::create([
			'food_id' => $food->id,
			'user_id' => auth()->user()->id,
			'restaurant_id' => $food->restaurant->id,
			'ingredients' => $ingredients ?? null,
			'quantity' => $quantity,
			'price' => (double)$price * (int)$quantity
		]);

		return back();
	}

}
