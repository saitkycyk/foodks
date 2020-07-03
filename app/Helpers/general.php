<?php

function restaurantRating($restaurant)
{
	return round($restaurant->restaurantReviews->avg('rate'));
}


function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
{
	$currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
	$currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
	parse_str(request()->getQueryString(), $query);
	unset($query[$pageName]);
	$paginator = new \Illuminate\Pagination\LengthAwarePaginator(
		$currentPageItems,
		$collection->count(),
		$perPage,
		$currentPage,
		[
			'pageName' => $pageName,
			'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
			'query' => $query,
			'fragment' => $fragment
		]
	);

	return $paginator;
}