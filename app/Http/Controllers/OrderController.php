<?php

namespace App\Http\Controllers;

use App\Events\OrdersUpdated;
use App\Food;
use App\Order;
use App\Order_Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderController extends Controller
{

	public function changeOrderGroupStatus($orderGroup, Request $request)
	{
		$orderGroup = Order_Group::findOrFail($orderGroup);

		$this->authorize('isOrderGroupRestaurant', $orderGroup);

		$request->validate([
			'operation' => 'required|in:delivered,canceled,onway,accepted'
		]);

		if($orderGroup->status != 'canceled' && $orderGroup->status != 'delivered') {
			$orderGroup->status = $request->operation;
			$orderGroup->save();
		}

		OrdersUpdated::dispatch($orderGroup->user_id);

		return back();
	}


	public function showRestaurantOrders()
	{
		$this->authorize('isRestaurant', User::class);

		$restaurantOrders = auth()->user()->restaurantOrderGroups->load('orders');

		$orderGroups = $restaurantOrders->filter(function ($value, $key) {
			return $value['status'] == 'pending' || $value['status'] == 'accepted' || $value['status'] == 'onway';
		});

		$oldOrderGroups = $restaurantOrders->filter(function ($value, $key) {
			return $value['status'] == 'canceled' || $value['status'] == 'delivered';
		});

		return view('restaurant_orders', compact(['orderGroups', 'oldOrderGroups']));
	}


	public function cancelOrderGroup($orderGroup)
	{
		$orderGroup = Order_Group::findOrFail($orderGroup);

		$this->authorize('isOrderGroupOwner', $orderGroup);

		if($orderGroup->status == 'pending' || $orderGroup->status == 'accepted') {
			$orderGroup->status = 'canceled';
			$orderGroup->save();
		}
		OrdersUpdated::dispatch($orderGroup->restaurant_id);

		return back();
	}


	public function showUserOrders()
	{
		$this->authorize('isUser', User::class);

		$userOrders = auth()->user()->order_groups->load('orders');

		$orderGroups = $userOrders->filter(function ($value, $key) {
			return $value['status'] == 'pending' || $value['status'] == 'accepted' || $value['status'] == 'onway';
		});

		$oldOrderGroups = $userOrders->filter(function ($value, $key) {
			return $value['status'] == 'canceled' || $value['status'] == 'delivered';
		});

		return view('user_orders', compact(['orderGroups', 'oldOrderGroups']));
	}


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

		OrdersUpdated::dispatch($orderGroup->restaurant_id);
		
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
		$this->authorize('isUser', User::class);
		
		$food = Food::findOrFail($food);

		$this->confirmUserPhoneCity($food);

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


	protected function confirmUserPhoneCity($food)
	{
		abort_if(auth()->user()->phone == null, 403, 'Nuk mund të porositni pa shtuar një numër të telefonit në profilin tuaj!');

		abort_if(auth()->user()->city_id == null, 403, 'Nuk mund të porositni pa shtuar një qytet dhe adres në profilin tuaj!');

		abort_if($food->restaurant->city_id != auth()->user()->city_id, 403, 'Restoranti nuk gjendet në qytetin tuaj, ju lutem porositni nga njëra restorantët që gjenden në qytetin tuaj!');
	}

}
