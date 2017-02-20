<?php

namespace App\Http\Controllers\Admin;

use App\Components\ApiResponse;
use App\Components\CacheName;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class CacheController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $keys = array_values(CacheName::getAllKey());
        $pages = array();
        $page = 3;

        foreach ($keys as $i => $key) {
            $pageSize = $i % $page;
            if (!isset($pages[$pageSize])) {
                $pages[$pageSize] = array();
            }

            $pages[$pageSize][$key[0]] = $key[1];
        }

        $data = array(
            'pages' => $pages,
        );

        return view('admin.cache.index', $data);
    }


    /**
     * 清除缓存
     * @param Request $request
     * @return ApiResponse
     */
    public function destroy(Request $request)
    {
        $this->validate($request, array(
            'key' => ['required', 'array']
        ));

        CacheName::clear($request->input('key'));

        return ApiResponse::buildFromArray();
    }

}