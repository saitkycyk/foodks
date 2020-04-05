<?php
use Illuminate\Http\Request;
use App\City;
use App\Road;
use App\Food;
use App\Order;
use App\Order_Group;
use App\Review;
use App\User;

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

Route::get('/', 'HomeController@homepage')->name('index');
//Route::view('/test', 'list_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/restaurants', 'RestaurantController@restaurantPage')->name('restaurants');



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
