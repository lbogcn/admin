<?php

Route::group(['namespace' => 'Callback'], function() {
    Route::post('qiniu/ueditor', 'QiniuController@ueditor');
});
