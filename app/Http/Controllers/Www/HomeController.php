<?php

namespace app\Http\Controllers\Www;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $pageSize = 20;
        $data = array(
            'paginate' => Article::getHomeArticles($page, $pageSize)
        );

//        dd($data);

        return view('www.home', $data);
    }

}