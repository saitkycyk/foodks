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
	public function orderPaymentPage($orderGroup)
	{
		$orderGroup = Order_Group::findOrFail($orderGroup);

		$this->authorize('isOrderGroupOwner', $orderGroup);

		$restaurant = $orderGroup->restaurant;

		return view('order-payment', compact('restaurant'));
	}


	public function storeCheckout($id, Request $request)
	{
		$restaurant = User::findOrFail($id);

		$data = $request->validate([
			'phone' => 'required',
			'address' => 'required',
		]);

		auth()->user()->update($data);

		$checkout = Order_Group::create([
			'user_id' => auth()->user()->id,
			'restaurant_id' => $restaurant->id,
			'status' => "unfinished",
			'note' => $request->note
		]);

		return redirect()->route('orderPaymentPage', ['orderGroup' => $checkout->id]);
	}


	public function orderDetailPage($restaurant)
	{
		abort_if(auth()->user()->cart->isEmpty(), 404);

		$restaurant = User::findOrFail($restaurant);

		return view('order-details', compact('restaurant'));
	}


	public function delete(Order $order)
	{
		$this->authorize('isOrderOwner', $order);

		$order->delete();

		return back();
	}


	public function store(Food $food, Request $request)
	{
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











	public function createOrderGroup(Request $request)
	{
		$orders = $this->validateOrder($request);
		$order_group = Order_Group::create([
			'payment_type' => $orders['payment_type'],
			'status' => 'pending',
			'user_id' => auth()->id()
		]);

		foreach($orders as $order){
			$order['order_group'] = $order_group->id;
			Order::create($order);
		}
	}
	//foreach at front and find orders and display
	public function showUserOrders()
	{
		$order_groups = auth()->user()->order_groups;
		return view('order-show', compact('order_groups'));
	}

	public function cancelOrder(Order_Group $order_group)
	{
		$this->authorize('isOrderOwner', User::class);
		if($order_group->created_at->addMinutes(10) >= now()){
			Session::flash('message', 'Ju nuk mund të anuloni porosinë më!');
			return back();
		}
		$order_group->status = 'canceled';
		$order_group->save();

		return back();
	}

	public function validateOrder($request)
	{
		return $request->validate([
			'order.*.food_id'		=> 'required|numeric',
			'payment_type' 			=> 'required|string',
			'order.*.ingredients' 	=> 'nullable|json',
			'order.*.quantity'		=> 'required|numeric',
		]);
	}
}
