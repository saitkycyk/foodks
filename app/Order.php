<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Food;
use App\Order_Group;

class Order extends Model
{
	use SoftDeletes;

	protected $guarded = [
		'id'
	];

	protected function food()
	{
		return $this->belongsTo(Food::class, 'food_id', 'id');
	}

	protected function order_group()
	{
		return $this->belongsTo(Order_Group::class, 'order_group_id', 'id');
	}
}
