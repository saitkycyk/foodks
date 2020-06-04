<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;
Use App\User;

class Order_Group extends Model
{
	use SoftDeletes;

	protected $guarded = [];

	protected $table = 'order_groups';

	public function orders()
	{
		return $this->hasMany(Order::class, 'order_group_id', 'id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}

	public function restaurant()
	{
		return $this->belongsTo(User::class, 'restaurant_id', 'id');
	}
}
