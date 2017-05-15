<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * 首页
     */
    public function index()
    {
        $data = array(
            'pageName' => '首页',
            'columnId' => null
        );

        return view('jiestyle2.list', $data);
    }

}