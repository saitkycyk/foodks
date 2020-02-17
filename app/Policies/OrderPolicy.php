<?php

namespace App\Policies;

use App\User;
use App\Order_Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function isOrdersFoodOwner($user, Order_Group $order_group)
    {
        return $user->id == $order_group->orders->food->user_id;
    }

    public function isOrderOwner($user, Order_Group $order_group)
    {
        return $user->id == $order_group->user_id;
    }
}
