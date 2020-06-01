<?php

namespace App\Http\Controllers;

use App\Food;
use App\Review;
use App\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
	public function rateRestaurant(User $id, Request $request)
	{
		$this->authorize('isUser', User::class);
		$this->authorize('checkIfRestaurant', $id);

		$data = $request->validate([
			'review' => 'nullable|string',
			'rate' => 'required|numeric|in:1,2,3,4,5'
		]);

		$review = Review::updateOrCreate([
			'user_id' => auth()->user()->id,
			'restaurant_id' => $id->id
		], $data);

		return back();
	}


	public function deleteRestaurantRating(User $id, Request $request)
	{
		$this->authorize('isUser', User::class);
		$this->authorize('checkIfRestaurant', $id);

		$review = Review::where('user_id', auth()->user()->id)->where('restaurant_id', $id->id)->first();

		$review->delete();
		
		return back();
	}


	public function getFoodRatings(Food $food)
	{
		$reviews = $food->reviews();
		$average = $reviews->avg('rate');
		$total  =$reviews->select('rate', DB::raw('count(rate) as total'))->groupBy('rate')->get();
		$foodReviews = ([
			'1' => 0,
			'2' => 0,
			'3' => 0,
			'4' => 0,
			'5' => 0
		]);
		foreach($total as $single)
		{
			$foodReviews[$single['rate']]=$single['total'];
		}
		$foodReviews['average'] = $average ?? 0;
		$foodReviews['reviews'] = $this->listReviews($food);
		$foodReviews['reviews']['user_review'] = $food->userReview();
		return $foodReviews;
	}

	public function updateOrCreate(Request $request)
	{
		$attributes = $this->validateReview($request);
		Review::withTrashed()->updateOrCreate([
			"food_id"  => $attributes['food_id'], 
			"user_id" => auth()->id()
		], [
			'deleted_at'=> null,
			'rate'      => $attributes['rate'],
			'review'    => $attributes['review']
		]);
		return back();
	}

	public function destroy(Review $review)
	{
		$this->authorize('reviewOwner', $review);
		$review = $review->where('user_id', auth()->id())->delete();
		return back();
	}

	public function listReviews(Food $food)
	{
		return Review::where('food_id', $food->id)->orderBy('updated_at', 'desc')->paginate(5);
	}

	public function validateReview($request)
	{
		return $request->validate([
			'rate'  =>'required|integer|min:1|max:5',
			'review'=>'sometimes|nullable|string',
			'food_id'=>'required|integer'
		]);
	}
}
