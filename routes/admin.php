<?php

/*
|--------------------------------------------------------------------------
| 管理后台路由
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'AuthController@showLoginForm')->name('login');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['admin']], function() {

    // 首页
    Route::get('/', 'HomeController@getIndex');
    Route::get('home', 'HomeController@getIndex');

    // 文章管理
    Route::patch('article-manage/article/up/{id}', 'ArticleManage\ArticleController@up');
    Route::patch('article-manage/article/down/{id}', 'ArticleManage\ArticleController@down');
    Route::patch('article-manage/comment/restore/{id}', 'ArticleManage\CommentController@restore');
    Route::resources(array(
        'article-manage/article' => 'ArticleManage\ArticleController',
        'article-manage/comment' => 'ArticleManage\CommentController',
    ));

    // 权限管理
    Route::resources(array(
        'permission/menu' => 'Permission\MenuController',
        'permission/user' => 'Permission\UserController',
        'permission/user.role' => 'Permission\UserRoleController',
        'permission/role' => 'Permission\RoleController',
        'permission/role.permission' => 'Permission\RolePermissionController',
        'permission/node' => 'Permission\NodeController',
    ));
});
