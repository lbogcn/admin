<?php

namespace App\Http\Controllers\Blog;

use App\Components\CacheName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * 首页
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $page = (int)$request->input('page');
        $redis = \RedisClient::connection();
        $key = config('cache.prefix') . ':' . CacheName::PAGE_HOME[0];
        if (!$redis->hexists($key, $page) || config('app.debug')) {
            $data = array(
                'pageName' => '首页',
                'columnId' => null
            );

            $redis->hset($key, $page, view('jiestyle2.list', $data)->render());
        }

        return $redis->hget($key, $page);
    }

}