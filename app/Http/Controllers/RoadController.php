<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Road;
use App\User;

class RoadController extends Controller
{
	public function show()
	{
		return Road::all();
	}

	public function create()
	{
		return view('road-create');
	}

	public function store(Request $request)
	{
		$data = $this->validateRoad($request);
		$road = Road::create($data);
		return back();
	}

	public function update(Road $road)
	{
		$data = $this->validateRoad($request);
		$road = Road::update($data);
		return back();
	}

	public function updatePage(Road $road)
	{
		return view('road-edit', compact('road'));
	}

	public function delete(Road $road)
	{
		$road->delete();
		return back();
	}

	public function validateRoad($request)
	{
		return $request->validate([
			'city_id' => 'required|numeric',
			'name'	=>	'required|string',
			'road_nr'	=>	'required|numeric',
			'location' => 'required|string'
		]);
	}
}
