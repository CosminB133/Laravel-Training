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

Route::get('/', 'IndexController');

Route::post('/', 'CartController@addToCart');
Route::get('/cart', 'CartController@index');
Route::post('/cart', 'CartController@removeFromCart');

Route::resource('/products', 'ProductsController')->except(['show'])->middleware('logged');

Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');

Route::resource('/orders', 'OrdersController')->only(['index', 'show', 'store']);
