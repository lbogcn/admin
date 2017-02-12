<?php

namespace app\Http\Controllers\Blog;

use App\Components\CacheName;
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
        $key = CacheName::PAGE_HOME;

        if (!\Cache::has($key)) {
            $data = array(
                'articles' => Article::getHomeArticles(),
                'title' => '最新文章'
            );

            $page = view('blog.list', $data)->render();

            \Cache::forever($key, $page);
        }

        return \Cache::get($key);
    }

}