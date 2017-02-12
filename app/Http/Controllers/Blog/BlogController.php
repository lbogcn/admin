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
        $key = \Cache::getPrefix() . CacheName::PAGE_ARTICLE;
        $redis = \RedisClient::connection();

        if (!$redis->hexists($key, $id)) {
            $data = array(
                'article' => Article::with('contents', 'tags')->findOrFail($id)
            );

            $page = view('blog.blog', $data)->render();

            $redis->hset($key, $id, $page);
        }

        return $redis->hget($key, $id);
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