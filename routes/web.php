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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/shop', 'ShopController@index')->name('shop');
Route::get('/checkout', 'ShopController@checkout')->name('checkout');
Route::get('/script', 'ScriptController@index')->name('dbscript');
Route::post('/go-checkout', 'ShopController@goCheckout')->name('gocheckout');

Route::post('/api/add_to_cart/{id}', 'ShopController@addToCart');
Route::post('/api/remove_from_cart/{id}', 'ShopController@removeFromCart');
