<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{

    public function create(Request $request)
    {
        $data = $request->validate([
            'category' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'drink' => 'required|boolean',
            'ingredients.*.ingPrice' => 'nullable|numeric',
            'ingredients.*.ingName' => 'nullable',
            'ingredients.*.ingDefault' => 'boolean',
        ]);

        $ingredients = [];
        foreach($data['ingredients'] as $ingredient){
            if($ingredient['ingName'] == null){
                continue;
            }

            array_push($ingredients, $ingredient);
        }

        $request->validate([
            'picture' => 'nullable|mimes:jpeg,bmp,png,svg'
        ]);

        $data['user_id'] = auth()->user()->id;
        $food = Food::create($data);
        empty($ingredients) ? $food->ingredients = null : $food->ingredients = json_encode($ingredients);

        $path = $request->file('picture')->storeAs('public/foods', 'Food'.$food->id.'.jpg');
        $path = str_replace('public', 'storage', $path);
        $food->picture = $path;
        $food->save();

        return back();
    }


    public function update(Food $food, Request $request)
    {
        $this->authorize('isFoodOwner', $food);

        $data = $request->validate([
            'category' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
            'drink' => 'required|boolean',
            'ingredients.*.ingPrice' => 'nullable|numeric',
            'ingredients.*.ingName' => 'nullable',
            'ingredients.*.ingDefault' => 'boolean',
        ]);

        $ingredients = [];
        foreach($data['ingredients'] as $ingredient){
            if($ingredient['ingName'] == null){
                continue;
            }

            array_push($ingredients, $ingredient);
        }

        $request->validate([
            'picture' => 'nullable|mimes:jpeg,bmp,png,svg'
        ]);

        $food->update($data);
        empty($ingredients) ? $food->ingredients = null : $food->ingredients = json_encode($ingredients);

        if($request->picture != null){

            $path = $request->file('picture')->storeAs('public/foods', 'Food'.$food->id.'.jpg');
            $path = str_replace('public', 'storage', $path);
            $food->picture = $path;
        }
        $food->save();

        return back();
    }


    public function delete(Food $food)
    {
        $this->authorize('isFoodOwner', $food);

        $food->delete();

        $path = str_replace('storage', 'public', $food->picture);
        Storage::delete($path);
        $food->picture = null;
        $food->save();

        return back();
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
