<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function profilePage()
	{
		$this->authorize('isUser', User::class);

		$user = auth()->user();

		return view('user_profile', compact('user'));
	}

	public function changeInfo(Request $request)
	{
		$this->authorize('isUser', User::class);
		
		$data = $request->validate([
			'phone' => 'required',
			'name' => 'required',
			'lastname' => 'required',
		]);

		auth()->user()->update($data);

		return back();
	}

}
