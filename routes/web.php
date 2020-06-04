<?php
use App\City;
use App\Food;
use App\Order;
use App\Order_Group;
use App\Review;
use App\Road;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
Auth::loginUsingId(2);
Route::get('/test', function () {
	$user = User::find(2);

	return dd($user->cart->isEmpty());

});
Route::get('/', 'HomeController@homepage')->name('index');
//Route::view('/test', 'list_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/restaurants', 'RestaurantController@restaurantsPage')->name('restaurants');
Route::get('/restaurant/{id}', 'RestaurantController@restaurantMenu')->name('restaurant-menu');
Route::get('/restaurant/{id}/profile', 'RestaurantController@restaurantProfile')->name('restaurant-profile');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/register/restaurant', 'RestaurantController@create')->name('createRestaurant');
Route::post('/register/restaurant', 'RestaurantController@store')->name('storeRestaurant');

//user
Route::get('/profile', 'UserController@profilePage')->name('userProfile');
Route::post('/profile/info', 'UserController@changeInfo')->name('changeUserInfo');

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

//ordering system
Route::post('/orders/{food}/create', 'OrderController@store')->name('createOrder');
Route::delete('/orders/{order}/delete', 'OrderController@delete')->name('deleteOrder');

//checkout system
Route::get('/restaurant/{id}/details', 'OrderController@orderDetailPage')->name('orderDetailPage');
Route::post('/restaurant/{id}/checkout/create', 'OrderController@storeCheckout')->name('createOrder');
Route::get('/checkout/{orderGroup}/payment', 'OrderController@orderPaymentPage')->name('orderPaymentPage');

Route::post('/checkout/{orderGroup}/final', 'OrderController@finishPayment')->name('finalizeOrder');

Route::get('/checkout/review', 'OrderController@orderReviewPage')->name('orderReviewPage');
