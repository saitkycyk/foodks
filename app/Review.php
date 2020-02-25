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

	
	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function food()
	{
		return $this->belongsTo(Food::class, 'food_id', 'id');
	}
}
