<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('/user')->group( function() {
Route::post('/login','api\user\LoginController@login');
Route::post('/register','api\user\LoginController@register');
});

Route::prefix('/user')->middleware('auth:api')->group( function() {
Route::get('/details','api\user\LoginController@details');
Route::post('logout','api\user\LoginController@logout');
});


// Route::prefix('/user')->middleware('auth:api')->group( function() {
Route::prefix('/user')->group( function() {
Route::post('/searchProduct','api\user\SearchProductController@save');
Route::post('/addShop','api\user\ShopController@save');
Route::get('/shops','api\user\ShopController@shops');
});
// Route::prefix('/masters')->middleware('auth:api')->group( function() {
Route::prefix('/masters')->group( function() {
	// Route::get('/category','api\masters\MasterController@productCategory');
	Route::get('/category','api\masters\MasterController@productCategory');
	Route::get('/region','api\masters\MasterController@region');
	Route::get('/pincodeDetail/{pincode}','api\masters\MasterController@pincodeDetail');
});
