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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart', 'CartController@addToCart');
Route::delete('/cart', 'CartController@removeFromCart');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout')->name('logout')->middleware('logged');

Route::post('/reviews', 'ReviewsController@store')->name('reviews.store');
Route::delete('/reviews/{id}', 'ReviewsController@destroy')->name('reviews.destroy')->middleware('logged');

Route::middleware('logged')->group(
    function () {
        Route::get('/products', 'ProductsController@index')->name('products');
        Route::get('/products/create', 'ProductsController@create')->name('products.create');
        Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
        Route::get('/products/{id}', 'ProductsController@show')->name('products.show')->withoutMiddleware('logged');
        Route::post('/products', 'ProductsController@store')->name('products.store');
        Route::patch('/products/{id}', 'ProductsController@update')->name('products.update');
        Route::delete('/products/{id}', 'ProductsController@destroy')->name('products.destroy');

        Route::resource('/orders', 'OrdersController')->only(['index', 'store', 'show'])->names(
            [
                'index' => 'orders',
                'store' => 'orders.store',
                'show' => 'orders.show',
            ]
        );
    }
);

