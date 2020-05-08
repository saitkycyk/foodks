<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Food;
use App\Order_Group;
use App\Review;
use App\City;
use App\Road;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'preferences' => 'json',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class, 'user_id', 'id');
    }

    public function order_groups()
    {
        return $this->hasMany(Order_Group::class, 'user_id', 'id');
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function road()
    {
        return $this->belongsTo(Road::class, 'road_id', 'id');
    }

    public function restaurantReviews()
    {
        return $this->hasMany(Review::class, 'restaurant_id', 'id');
    }

    public function restaurants()
    {
        return $this->where('restaurant', true);
    }

}
