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
     * 所有文章
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $key = CacheName::PAGE_BLOG_LIST;

        if (!\Cache::has($key)) {
            $articles = Article::getAllArticles();
            $groups = array();

            foreach ($articles as $article) {
                $date = mb_substr($article['created_at'], 0, 7);
                if (!isset($groups[$date])) {
                    $groups[$date] = array();
                }

                $groups[$date][] = $article;
            }

            $data = array(
                'pageName' => '文章',
                'total' => count($articles),
                'groups' => $groups
            );

            $page = view('blog.group', $data)->render();

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
        $key = \Cache::getPrefix() . CacheName::PAGE_ARTICLE;
        $redis = \RedisClient::connection();

        if (!$redis->hexists($key, $id)) {
            $article = Article::with('contents', 'tags')->findOrFail($id);

            $data = array(
                'article' => $article,
                'pageName' => $article['title']
            );

            $page = view('blog.detail', $data)->render();

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
        $pageSize = 15;

        $paginate = ArticleColumnsRelation::getColumnArticles($column['id'], $page, $pageSize);
        $articles = array();

        foreach ($paginate as $item) {
            $articles[] = $item['article'];
        }

        $data = array(
            'articles' => $articles,
            'pageName' => $column['column_name'],
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