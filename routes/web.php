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

Route::get('/api', 'ApiController@index');

Route::get('/home', 'Customer\HomeController@index');

Route::get('/product/{id}', 'Product\ProductController@index');

