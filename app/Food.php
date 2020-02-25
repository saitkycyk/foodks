<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Review;
use App\Order;

class Food extends Model
{
	use SoftDeletes;
	
	protected $guarded = [
		'id'
	];

	public function restaurant()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function reviews()
	{
		return $this->hasMany(Review::class, 'food_id', 'id');
	}

	public function userReview()
	{
		return $this->reviews()->where('user_id', auth()->id())->first();
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'food_id', 'id');
	}
}
