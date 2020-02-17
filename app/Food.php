<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Review;

class Food extends Model
{
	use SoftDeletes;
	
	protected $guarded = [
		'id'
	];

	protected function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	protected function reviews()
	{
		return $this->hasMany(Review::class, 'user_id', 'id');
	}

	public function userReview()
	{
		return $this->reviews()->where('user_id', auth()->id())->first();
	}
}
