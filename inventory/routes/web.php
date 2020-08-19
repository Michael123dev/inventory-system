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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// Customers
Route::get('/search', 'CustomersController@search');
Route::get('/customers', 'CustomersController@index');
Route::get('/customers/create', 'CustomersController@create');
Route::get('/customers/{customer}', 'CustomersController@show');
Route::post('/customers', 'CustomersController@store');
Route::delete('/customers/{customer}', 'CustomersController@destroy');
Route::get('/customers/{customer}/edit', 'CustomersController@edit');
Route::patch('/customers/{customer}', 'CustomersController@update');

//Suppliers
Route::get('/searchsuppliers', 'SuppliersController@search');
Route::get('/suppliers', 'SuppliersController@index');
Route::get('/suppliers/create', 'SuppliersController@create');
Route::get('/suppliers/{supplier}', 'SuppliersController@show');
Route::post('/suppliers', 'SuppliersController@store');
Route::delete('/suppliers/{supplier}', 'SuppliersController@destroy');
Route::get('/suppliers/{supplier}/edit', 'SuppliersController@edit');
Route::patch('/suppliers/{supplier}', 'SuppliersController@update');

//Stocks
Route::get('/searchstocks', 'StocksController@search');
Route::get('/stocks', 'StocksController@index');
Route::get('/stocks/create', 'StocksController@create');
Route::post('/stocks', 'StocksController@store');
Route::get('/stocks/{stock}/edit', 'StocksController@edit');
Route::patch('/stocks/{stock}', 'StocksController@update');
Route::delete('/stocks/{stock}', 'StocksController@destroy');

//Sales
Route::get('/searchsales', 'SalesController@search');
Route::get('/sales', 'SalesController@index');
Route::get('/sales/create', 'SalesController@create');
Route::post('/sales', 'SalesController@store');
Route::get('/sales/{sale}/edit', 'SalesController@edit');
Route::patch('/sales/{sale}', 'SalesController@update');
Route::delete('/sales/{sale}', 'SalesController@destroy');

//Purchases
Route::get('/searchpurchases', 'PurchasesController@search');
Route::get('/purchases', 'PurchasesController@index');
Route::get('/purchases/create', 'PurchasesController@create');
Route::post('/purchases', 'PurchasesController@store');
Route::get('/purchases/{purchase}/edit', 'PurchasesController@edit');
Route::patch('/purchases/{purchase}', 'PurchasesController@update');
Route::delete('/purchases/{purchase}', 'PurchasesController@destroy');

// Users
Route::get('/searchusers', 'UsersController@search');
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::get('/users/{user}', 'UsersController@show');
Route::post('/users', 'UsersController@store');
Route::get('/users/{user}/edit', 'UsersController@edit');
Route::patch('/users/{user}', 'UsersController@update');
Route::delete('/users/{user}', 'UsersController@destroy');

