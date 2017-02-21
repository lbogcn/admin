<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\ArticleColumn;
use App\Models\ArticleColumnsRelation;
use Illuminate\Http\Request;

class ColumnController extends Controller
{

    /**
     * 所有栏目
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $columns = ArticleColumn::homeColumns();
        $data = array(
            'pageName' => '栏目',
            'columns' => $columns,
        );

        return view('blog.columns', $data);
    }

    /**
     * 栏目详情（显示栏目下的文章列表）
     * @param Request $request
     * @param $alias
     * @return mixed
     */
    public function detail(Request $request, $alias)
    {
        /** @var ArticleColumn $column */
        $column = ArticleColumn::findByAliasOrFail($alias);

        if ($column->type == ArticleColumn::TYPE_PAGE) {
            return $this->detailPage($column);
        } else {
            $page = $request->input('page');
            return $this->detailList($column, $page);
        }
    }

    /**
     * 页面详情
     * @param ArticleColumn $column
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function detailPage($column)
    {
        /** @var ArticleColumnsRelation $relation */
        $relation = ArticleColumnsRelation::getFirstOrFailColumnArticles($column->id);
        $article = $relation->article;
        $article->load('tags');

        $data = array(
            'article' => $article,
            'blogKeywords' => implode(',', array_column($article['tags']->toArray(), 'tag')),
            'blogDescription' => $article['title'],
            'pageName' => $article['title']
        );

        return view('blog.detail', $data);
    }

    /**
     * 列表详情
     * @param ArticleColumn $column
     * @param $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function detailList($column, $page)
    {
        $pageSize = 15;

        $paginate = ArticleColumnsRelation::getColumnArticles($column->id, $page, $pageSize);
        $articles = array();

        foreach ($paginate as $item) {
            $articles[] = $item['article'];
        }

        $data = array(
            'articles' => $articles,
            'pageName' => $column->column_name,
            'paginate' => $paginate->render(),
            'title' => $column->column_name
        );

        return view('blog.list', $data);
    }


}