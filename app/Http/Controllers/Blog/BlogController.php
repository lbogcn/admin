<?php

namespace app\Http\Controllers\Blog;

use App\Components\CacheName;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleColumn;
use App\Models\ArticleColumnsRelation;
use Illuminate\Http\Request;

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

    /**
     * 栏目文章
     * @param Request $request
     * @param $alias
     * @return mixed
     */
    public function column(Request $request, $alias)
    {
        $column = ArticleColumn::findByAliasOrFail($alias);
        $page = $request->input('page');
        $pageSize = 3;

        $paginate = ArticleColumnsRelation::getColumnArticles($column['id'], $page, $pageSize);
        $articles = array();

        foreach ($paginate as $item) {
            $articles[] = $item['article'];
        }

        $data = array(
            'articles' => $articles,
            'paginate' => $paginate->render(),
            'title' => $column['column_name']
        );

        return view('blog.list', $data);
    }

    public function tag($tag)
    {
        dd($tag);
    }

}