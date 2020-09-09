<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'IndexController@index');

Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@addToCart');
Route::delete('/cart', 'CartController@removeFromCart');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout')->middleware('logged');

Route::post('/reviews', 'ReviewsController@store');
Route::delete('/reviews/{id}', 'ReviewsController@destroy')->middleware('logged');

Route::middleware('logged')->group(
    function () {
        Route::get('products', 'ProductsController@index');
        Route::get('products/create','ProductsController@create');
        Route::get('products/{id}/edit', 'ProductsController@edit');
        Route::get('products/{id}', 'ProductsController@show')->withoutMiddleware('logged');
        Route::post('products','ProductsController@store');
        Route::patch('products/{id}', 'ProductsController@update');
        Route::delete('products/{id}', 'ProductsController@destroy');

        Route::resource('/orders', 'OrdersController');
    }
);

