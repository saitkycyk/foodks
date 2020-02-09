<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function isOrdersFoodOwner($user, Order_Group $order_group)
    {
        return $user->id == $order_group->orders->food->user_id;
    }

    public function isOrderOwner($user, Order_Group $order_group)
    {
        return $user->id == $order_group->user_id;
    }
}
