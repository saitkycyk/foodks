<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isRestaurant($user)
    {
        return $user->restaurant;
    }

    public function isUser($user)
    {
        return !$user->restaurant;
    }

    public function checkIfRestaurant($user, $restaurant)
    {
        return $restaurant->restaurant;
    }
}
