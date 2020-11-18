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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/footerheader-test', 'layouts/main');

Route::view('/react-test', 'react-test');

Route::view('/index', 'customer.test');
Route::get('/product/{id?}/{variant?}', 'Customer\ProductController@show')->name('customer.product.show');
Route::get('/prepare_product/{id?}', 'Customer\ProductController@prepare')->name('customer.product.prepare');

Route::get('/api', 'ApiController@index');

Route::get('/api/product/{id}/articles/{init_selection?}','Api\Customer\ArticleController@product_articles');
Route::post('/api/order/add','Api\Customer\OrderController@add');