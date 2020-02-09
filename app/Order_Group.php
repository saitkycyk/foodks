<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;
Use App\User;

class Order_Group extends Model
{
	use SoftDeletes;

	protected $table = 'order_groups';

	protected $guarded = 'id';

	protected function orders()
	{
		return $this->hasMany(Order::class, 'order_group_id', 'id');
	}

	protected function user()
	{
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
