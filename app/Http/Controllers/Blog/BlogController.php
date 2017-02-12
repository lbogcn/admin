<?php

namespace app\Http\Controllers\Blog;

use App\Components\CacheName;
use App\Http\Controllers\Controller;
use App\Models\Article;

class BlogController extends Controller
{

    /**
     * 文章详情
     * @param $id
     * @return mixed
     */
    public function index($id)
    {
        $key = CacheName::PAGE_ARTICLE . $id;
        if (!\Cache::has($key)) {
            $data = array(
                'article' => Article::with('contents', 'tags')->findOrFail($id)
            );

            $page = view('blog.blog', $data)->render();
            \Cache::forever($key, $page);
        }

        return \Cache::get($key);
    }

    public function column($alias)
    {
        dd($alias);
    }

    public function tag($tag)
    {
        dd($tag);
    }

}