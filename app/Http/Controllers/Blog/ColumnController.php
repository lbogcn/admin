<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleColumn;
use App\Models\ArticleColumnsRelation;

class ColumnController extends Controller
{

    /**
     * 栏目详情
     * @param $alias
     * @return mixed
     */
    public function detail($alias)
    {
        /** @var ArticleColumn $column */
        $column = ArticleColumn::findByAliasOrFail($alias);

        if ($column->type == ArticleColumn::TYPE_PAGE) {
            return $this->detailView($column);
        } else {
            return $this->listView($column);
        }
    }

    /**
     * 栏目详情页
     * @param ArticleColumn $column
     * @return string
     */
    private function detailView($column)
    {
        /** @var ArticleColumnsRelation $articleRelation */
        $articleRelation = ArticleColumnsRelation::select('article_id')
            ->where('column_id', $column->id)
            ->orderBy('article_id', 'desc')
            ->firstOrFail();

        $article = Article::with('contents', 'tags', 'columns')
            ->where('status', Article::STATUS_RELEASE)
            ->findOrFail($articleRelation->article_id);

        $data = array(
            'article' => $article,
            'blogKeywords' => implode(',', array_column($article['tags']->toArray(), 'tag')),
            'blogDescription' => $article['title'],
            'pageName' => $article['title']
        );

        return view('jiestyle2.column_detail', $data)->render();
    }

    /**
     * 栏目文章列表
     * @param ArticleColumn $column
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function listView($column)
    {
        $data = array(
            'pageName' => $column->column_name,
            'columnId' => $column->id,
        );

        return view('jiestyle2.list', $data);
    }


}