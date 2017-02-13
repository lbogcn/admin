<?php

namespace app\Http\Controllers\Blog;

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
    }

    /**
     * 栏目详情（显示栏目下的文章列表）
     * @param Request $request
     * @param $alias
     * @return mixed
     */
    public function detail(Request $request, $alias)
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


}