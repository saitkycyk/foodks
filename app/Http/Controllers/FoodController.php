<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function show()
    {

    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store(Request $request)
    {
        $this->authorize('isRestaurant', User::class);
        $food = $this->validateFood($request);

        $food['user_id'] = auth()->id();
        $food['picture'] = $request->file('picture')->store('FoodLogo');
        $food['picture'] = Storage::url($food['picture']);
        Food::create($food);

        return back();        
    }

    public function update(Food $food, Request $request)
    {
        $this->authorize('isFoodOwner', $food);

        $data = $this->validateFood($request);
        $food->update($data);

        if (!is_null(request('picture'))) {
            if($food->picture){
                Storage::delete($food->picture);
            }
            $food->update(['picture'=>request()->file('picture')->store('FoodLogo')]);
        }
    }

    public function delete(Food $food)
    {
        $this->authorize('isFoodOwner', $food);

        $food->delete();
        Storage::delete($food->picture);
    }

    public function validateFood($request)
    {
        return $request->validate([
            'name'          => 'required|string',
            'description'   => 'nullable|string',
            'price'         => 'required|double',
            'sale'          => 'required|boolean',
            'picture'       => 'nullable|mimes:png,jpeg,svg',
            'ingredients'   => 'nullable|json',
            'drink'         => 'required|boolean',
        ]);
    }
}
