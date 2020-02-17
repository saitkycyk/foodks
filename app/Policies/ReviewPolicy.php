<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function reviewOwner($user, $review)
    {
        return auth()->id() == $review->user_id;
    }
}
