<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Food;

class Review extends Model
{
	use SoftDeletes;

	protected $guarded = [
		'id'
	];

	
	protected function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	protected function food()
	{
		return $this->belongsTo(Food::class, 'food_id', 'id');
	}
}
