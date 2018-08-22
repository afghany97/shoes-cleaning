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

// suppliers routes

Route::get('/suppliers','SuppliersController@index')->name('suppliers');

Route::post('/suppliers','SuppliersController@store')->name('supplier.store');

Route::get('/suppliers/create','SuppliersController@create')->name('supplier.create');

Route::get('/suppliers/{supplier}/edit','SuppliersController@edit')->name('supplier.edit');

Route::post('/suppliers/{supplier}/update','SuppliersController@update')->name('supplier.update');

Route::delete('/suppliers/{supplier}/delete','SuppliersController@destroy')->name('supplier.destroy');

// products routes

Route::get('/products/create','ProductsController@create')->name('product.create');

Route::get('/products','ProductsController@index')->name('products');

Route::post('/products','ProductsController@store')->name('product.store');

Route::get('/products/{product}/edit','ProductsController@edit')->name('product.edit');

Route::post('/products/{product}/update','ProductsController@update')->name('product.update');

Route::delete('/products/{product}/delete','ProductsController@destroy')->name('product.destroy');
