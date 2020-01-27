<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

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
}
