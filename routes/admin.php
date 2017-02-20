<?php

Route::group(['namespace' => 'Admin'], function() {
    // SQL日志分析
    Route::get('sqlLog', 'HomeController@sqlExplain');

    Route::get('login', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::group(['middleware' => ['admin']], function() {

        // 首页
        Route::get('/', 'HomeController@index');
        Route::get('home', 'HomeController@index');

        // UEditor
        Route::get('ueditor', 'HomeController@ueditor');

        // 修改密码
        Route::get('modify-password', 'AuthController@modifyPasswordForm')->name('modify-password');
        Route::post('modify-password', 'AuthController@modifyPassword')->name('modify-password');

        // 文章管理
        Route::patch('article-manage/article/up/{id}', 'ArticleManage\ArticleController@up');
        Route::patch('article-manage/article/down/{id}', 'ArticleManage\ArticleController@down');
        Route::post('article-manage/article/preview', 'ArticleManage\ArticleController@preview');
        Route::patch('article-manage/comment/restore/{id}', 'ArticleManage\CommentController@restore');
        Route::patch('article-manage/comment/deny/{id}', 'ArticleManage\CommentController@deny');
        Route::resources(array(
            'article-manage/article' => 'ArticleManage\ArticleController',
            'article-manage/comment' => 'ArticleManage\CommentController',
            'article-manage/column' => 'ArticleManage\ColumnController',
        ));

        // 配置选项
        Route::resource('option', 'OptionController');

        // 缓存管理
        Route::delete('cache', 'CacheController@destroy');
        Route::get('cache', 'CacheController@index');

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

});
