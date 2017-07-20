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

// Route Category
Route::group(['prefix' => 'admin/category'], function(){
    Route::get('/', 'CategoryController@index');
    Route::get('/{id}', 'CategoryController@edit');
    Route::post('/', 'CategoryController@store');
    Route::post('/{id}', 'CategoryController@update');
});

// Route Product

Route::group(['prefix' => 'admin/product'], function (){
   Route::get('/', 'ProductController@index');
   Route::get('/{id?}', 'ProductController@edit');
   Route::post('/', 'ProductController@store');
   Route::post('/{id}', 'ProductController@update');
});
