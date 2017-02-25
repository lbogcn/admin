<?php

namespace App\Http\Controllers\Blog;

use App\Components\CacheName;
use App\Http\Controllers\Controller;
use App\Models\Article;

class BlogController extends Controller
{

    /**
     * 所有文章
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $key = CacheName::PAGE_BLOG_LIST[0];

        if (!\Cache::has($key) || config('app.debug')) {
            $articles = Article::getAllArticles();

            $data = array(
                'pageName' => '所有文章',
                'articles' => $articles,
                'title' => '所有文章'
            );

            $page = view('blog.list', $data)->render();

            \Cache::forever($key, $page);
        }

        return \Cache::get($key);
    }

    /**
     * 文章详情
     * @param $id
     * @return mixed
     */
    public function detail($id)
    {
        $key = \Cache::getPrefix() . CacheName::PAGE_ARTICLE[0];
        $redis = \RedisClient::connection();

        if (!$redis->hexists($key, $id) || config('app.debug')) {
            $article = Article::with('contents', 'tags')
                ->where('status', Article::STATUS_RELEASE)
                ->findOrFail($id);

            $data = array(
                'article' => $article,
                'blogKeywords' => implode(',', array_column($article['tags']->toArray(), 'tag')),
                'blogDescription' => $article['title'],
                'pageName' => $article['title']
            );

            $page = view('blog.detail', $data)->render();

            $redis->hset($key, $id, $page);
        }

        return $redis->hget($key, $id);
    }

}