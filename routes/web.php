<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@homepage')->name('index');
Route::get('/restaurants', 'RestaurantController@restaurantsPage')->name('restaurants');
Route::get('/restaurant/{id}', 'RestaurantController@restaurantMenu')->name('restaurant-menu');
Route::get('/restaurant/{id}/profile', 'RestaurantController@restaurantProfile')->name('restaurant-profile');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contacts', 'HomeController@contacts')->name('contacts');
Route::get('/register/restaurant', 'RestaurantController@create')->name('createRestaurant');
Route::post('/register/restaurant', 'RestaurantController@store')->name('storeRestaurant');

Route::middleware('auth:web')->group(function () {

	//user
	Route::get('/profile', 'UserController@profilePage')->name('userProfile');
	Route::post('/profile/info', 'UserController@changeInfo')->name('changeUserInfo');
	Route::delete('/profile/delete', 'UserController@deleteUser')->name('deleteUser');

	//restaurant
	Route::get('/admin', 'RestaurantController@adminPage')->name('adminPage');
	Route::post('/admin/logo', 'RestaurantController@changeLogo')->name('changeRestaurantLogo');
	Route::post('/admin/address', 'RestaurantController@changeAddress')->name('changeRestaurantAddress');
	Route::post('/admin/info', 'RestaurantController@changeInfo')->name('changeRestaurantInfo');
	Route::post('/admin/preferences', 'RestaurantController@changePreferences')->name('changeRestaurantPreferences');
	Route::post('/admin/changepassword', 'RestaurantController@changePassword')->name('changeRestaurantPassword');
	Route::post('/admin/changeemail', 'RestaurantController@changeEmail')->name('changeRestaurantEmail');
	Route::post('/admin/food/create', 'FoodController@create')->name('createFood');
	Route::patch('/admin/food/update/{food}', 'FoodController@update')->name('updateFood');
	Route::delete('/admin/food/delete/{food}', 'FoodController@delete')->name('deleteFood');

	//rating
	Route::post('/restaurant/{id}/profile/rate', 'ReviewController@rateRestaurant')->name('rateRestaurant');
	Route::delete('/restaurant/{id}/profile/rate', 'ReviewController@deleteRestaurantRating')->name('deleteRestaurantRating');

	//user ordering system
	Route::get('/orders', 'OrderController@showUserOrders')->name('userOrders');
	Route::post('/orders/{food}/create', 'OrderController@store')->name('createOrder');
	Route::delete('/orders/{order}/delete', 'OrderController@delete')->name('deleteOrder');
	Route::delete('/orderGroup/{orderGroup}/cancel', 'OrderController@cancelOrderGroup')->name('cancelOrderGroup');

	//restaurant order management
	Route::get('/orders/restaurant', 'OrderController@showRestaurantOrders')->name('restaurantOrders');
	Route::patch('/orderGroup/{orderGroup}/status', 'OrderController@changeOrderGroupStatus')->name('changeOrderGroupStatus');

	//checkout system
	Route::get('/restaurant/{id}/checkout/details', 'OrderController@orderDetailPage')->name('orderDetailPage');
	Route::post('/restaurant/{id}/checkout/create', 'OrderController@storeCheckout')->name('checkoutOrder');
	Route::post('/checkout/{orderGroup}/final', 'OrderController@finishPayment')->name('finalizeOrder');
	Route::get('/checkout/review', 'OrderController@orderReviewPage')->name('orderReviewPage');
});