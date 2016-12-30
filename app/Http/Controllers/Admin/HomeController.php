<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * 后台入口
     */
    public function getIndex()
    {
        return view('admin.home');
    }

    public function getGoods()
    {
        return __FUNCTION__;
    }

    public function getArticle()
    {
        return __FUNCTION__;
    }


    public function getApi()
    {
        return __FUNCTION__;
    }

    public function getSubject()
    {
        return __FUNCTION__;
    }


}