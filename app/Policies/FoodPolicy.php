<?php

namespace App\Policies;

use App\User;
use App\Food;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodPolicy
{
    use HandlesAuthorization;

    public function isFoodOwner($user, $food)
    {
        return auth()->id() == $food->user_id;
    }
}
