<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
	public function show()
	{
		return City::all();
	}

	public function store(Request $request)
	{
		$data = $this->validateCity($request);
		$city = City::create($data);
		return back();
	}

	public function update(City $city)
	{
		$data = $this->validateCity($request);
		$city = City::update($data);
		return back();
	}

	public function updatePage(City $city)
	{
		return view('city-edit', compact('city'));
	}

	public function delete(City $city)
	{
		$city->delete();
		return back();
	}

	public function validateCity($request)
	{
		return $request->validate([
			'name'	=>	'required|string',
			'location' => 'required|string'
		]);
	}
}
