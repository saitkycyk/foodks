<?php

namespace App\Policies;

use App\Order;
use App\Order_Group;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
	use HandlesAuthorization;

	public function isOrderGroupRestaurant($user, Order_Group $order_group)
	{
		return $user->id == $order_group->restaurant_id;
	}

	public function isOrderGroupOwner($user, Order_Group $order_group)
	{
		return $user->id == $order_group->user_id;
	}

	public function isOrderOwner($user, Order $order)
	{
		return $user->id == $order->user_id;
	}
}
