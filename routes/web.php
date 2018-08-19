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

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/orders/create', 'OrdersController@create')->name('order.create');

Route::post('/orders', 'OrdersController@store')->name('order.store');

Route::get('/orders', 'OrdersController@index')->name('orders');

Route::get('/orders/{order}', 'OrdersController@show')->name('order.show');

Route::get('/shoes/create', 'ShoesController@create')->name('shoes.create');

Route::post('/shoes', 'ShoesController@store')->name('shoes.store');

Route::get('/customers/find/{mobile}', 'CustomerController@show')->name('customer.find');