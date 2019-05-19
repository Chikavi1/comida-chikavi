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
    return redirect('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
   
Route::get('/home', 'CategoriesController@index')->name('home');
Route::get('/seleccion/{titulo}','ProductsController@index')->name('seleccion');

//despues editar
Route::get('/carrito','RevisionController@index')->name('revision');

Route::post('/caca/{product}','InShoppingCartsController@create');
Route::get('/carrito/{product}','InShoppingCartsController@delete')->name('delete');
Route::get('/payment_method','ProductsController@payment_method')->name('payment_method');
Route::get('/finish_payment','InShoppingCartsController@finish_payment')->name('finish_payment');
Route::get('/pago','InShoppingCartsController@payment')->name('pago');
});