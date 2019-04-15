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

Route::get('/', [
	'uses' => 'ClientController@index',
	'as' => 'index'
])->middleware('checkLogin');


Route::get('/client', [
	'uses' => 'ClientController@create',
	'as' => 'create'
])->middleware('checkLogin');


Route::get('/client/{id}/edit', [
	'uses' => 'ClientController@edit',
	'as' => 'edit'
])->middleware('checkLogin');;


Route::get('/client/{id}/receipt', [
	'uses' => 'ReceiptController@create',
	'as' => 'create'
])->middleware('checkLogin');;


Route::post('/client', [
	'uses' => 'ClientController@store',
	'as' => 'store'
])->middleware('checkLogin');;


Route::post('/client/{id}/receipt', [
	'uses' => 'ReceiptController@store',
	'as' => 'store'
])->middleware('checkLogin');;


Route::put('/client/{id}', [
	'uses' => 'ClientController@update',
	'as' => 'update'
])->middleware('checkLogin');;


Route::get('/receipt/{client_id}', [
	'uses' => 'ReceiptController@index',
	'as' => 'index'
])->middleware('checkLogin');;


Route::post('/client/csv', [
	'uses' => 'ClientController@csv',
	'as' => 'csv'
])->middleware('checkLogin');;


Route::delete('/client/{id}', [
	'uses' => 'ClientController@destroy',
	'as' => 'destroy'
])->middleware('checkLogin');;


Route::get('/receipt/{client_id}/{receipt_id}', [
	'uses' => 'ReceiptController@download',
	'as' => 'download'
])->middleware('checkLogin');


Route::get('/login', [
	'uses' => 'UserController@index',
	'as' => 'index'
]);


Route::post('/login', [
	'uses' => 'UserController@login',
	'as' => 'login'
]);