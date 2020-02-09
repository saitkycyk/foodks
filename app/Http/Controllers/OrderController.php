<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Order_Group;
use App\User;
use App\Order;

class OrderController extends Controller
{

	public function create()
	{
		return view('order-create');
	}

	public function store(Request $request)
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

		return back();
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
