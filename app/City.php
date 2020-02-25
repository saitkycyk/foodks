<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Road;

class City extends Model
{
	use SoftDeletes;

	protected $guarded = [
		'id'
	];

	public function roads()
	{
		return $this->hasMany(Road::class, 'city_id', 'id');
	}
}
