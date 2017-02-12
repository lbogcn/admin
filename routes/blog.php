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

Route::group(['middleware' => ['blog']], function() {
    Route::get('/', 'HomeController@index');


    Route::get('blog/{id}', 'BlogController@index');
    Route::get('column/{alias}', 'BlogController@column');
    Route::get('tag/{tag}', 'BlogController@tag');
});