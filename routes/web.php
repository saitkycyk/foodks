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
	$res = User::find(1);
	dd($res->foods->sortByDesc('created_at'));
	foreach($res->foods->orderBy('created_at') as $food){

	}

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

Route::get('/profile', 'UserController@profilePage')->name('userProfile');
Route::post('/profile/info', 'UserController@changeInfo')->name('changeUserInfo');

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

Route::post('/restaurant/{id}/profile/rate', 'ReviewController@rateRestaurant')->name('rateRestaurant');
Route::delete('/restaurant/{id}/profile/rate', 'ReviewController@deleteRestaurantRating')->name('deleteRestaurantRating');
