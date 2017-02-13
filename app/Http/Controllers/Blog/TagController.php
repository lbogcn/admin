<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * 所有标签
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $tags = ArticleTag::getAllTag();
        $data = array(
            'pageName' => '标签',
            'tags' => $tags,
        );

        return view('blog.tags', $data);
    }

    /**
     * 标签详情
     * @param Request $request
     * @param $tag
     * @return mixed
     */
    public function detail(Request $request, $tag)
    {
        $page = $request->input('page');
        $pageSize = 15;
        $paginate = ArticleTag::getTagArticles($tag, $page, $pageSize);
        $articles = array();

        foreach ($paginate as $item) {
            $articles[] = $item['article'];
        }

        $data = array(
            'articles' => $articles,
            'paginate' => $paginate->render(),
            'title' => $tag,
            'pageName' => $tag,
        );

        return view('blog.list', $data);
    }


}