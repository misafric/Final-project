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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'Customer\HomeController@index');

Route::view('/footerheader-test', 'layouts/main');

Route::get('/product/{id?}/{variant?}', 'Customer\ProductController@show')->name('customer.product.show');
Route::get('/prepare_product/{id?}', 'Customer\ProductController@prepare')->name('customer.product.prepare');

Route::get('/api', 'ApiController@index');

Route::view('/cart', 'customer.cart')->name('cart');

Route::get('/api/product/{id}/articles/{init_selection?}','Api\Customer\ArticleController@product_articles');
Route::post('/api/cart/add','Api\Customer\CartController@add');
Route::post('/api/cart/remove','Api\Customer\CartController@remove');
Route::post('/api/cart/edit','Api\Customer\CartController@edit');
Route::post('/api/cart/empty','Api\Customer\CartController@empty');
Route::get('/api/cart/index','Api\Customer\CartController@index');

Route::get('/order-view/{id}', 'Customer\OrderController@show')->name('customer.order.show');

Route::get('/category/{id}', 'Product\ProductController@index')->name('customer.category.index');
Route::get('/category/{id}/filter', 'Product\ProductController@filter')->name('customer.category.filter');

Route::post('/cart/add', 'AddController@add');
Route::post('/try', 'TryController@try');

