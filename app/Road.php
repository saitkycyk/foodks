<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\City;

class Road extends Model
{
	use SoftDeletes;

	protected $guarded = [
		'id'
	];


	protected function city()
	{
		return $this->belongsTo(City::class, 'city_id', 'id');
	}
}
