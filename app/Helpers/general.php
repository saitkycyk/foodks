<?php

function restaurantRating($restaurant)
{
	return round($restaurant->restaurantReviews->avg('rate'));
}