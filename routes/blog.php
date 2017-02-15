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

Route::group(['middleware' => ['blog'], 'namespace' => 'Blog'], function() {
    // 首页
    Route::get('/', 'HomeController@index');

    // 关于
    Route::get('about', 'HomeController@about');

    // 博客
    Route::get('blog', 'BlogController@index');
    Route::get('blog/{id}', 'BlogController@detail');

    // 栏目
    Route::get('column', 'ColumnController@index');
    Route::get('column/{alias}', 'ColumnController@detail');

    // 标签
    Route::get('tag', 'TagController@index');
    Route::get('tag/{tag}', 'TagController@detail');
});
