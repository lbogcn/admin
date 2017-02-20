<?php

namespace App\Http\Controllers\Blog;

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
        $key = CacheName::PAGE_HOME[0];

        if (!\Cache::has($key)) {
            $data = array(
                'pageName' => get_option('blog_subtitle'),
                'articles' => Article::getHomeArticles(),
                'title' => '最新文章'
            );

            $page = view('blog.list', $data)->render();

            \Cache::forever($key, $page);
        }

        return \Cache::get($key);
    }

    /**
     * 关于页面
     * @return string
     */
    public function about()
    {
        $aboutArtileId = get_option('about_artile_id');

        return (new BlogController())->detail($aboutArtileId);
    }

}