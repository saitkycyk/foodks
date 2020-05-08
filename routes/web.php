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


	// City::create([
	// 	'name' => 'test',
	// 	'location' => 'idk',
	// 	'created_at' => now()
	// ]);
	// $res = User::where('restaurant', true)->first();
	// return json_decode($res->preferences)->description;

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
Route::get('/admin', 'RestaurantController@adminPage')->name('adminPage');

Route::post('/admin/logo', 'RestaurantController@changeLogo')->name('changeRestaurantLogo');
Route::post('/admin/address', 'RestaurantController@changeAddress')->name('changeRestaurantAddress');
Route::post('/admin/info', 'RestaurantController@changeInfo')->name('changeRestaurantInfo');


//Food
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');

//Order
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');

//Review
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');

//City
// Route::get()->name('');
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');

//Road
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');

//User
// Route::get()->name('');
// Route::post()->name('');
// Route::patch()->name('');
// Route::delete()->name('');
