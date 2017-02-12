<?php

namespace app\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\ArticleColumn;
use App\Models\ArticleColumnsRelation;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * 所有标签
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
    }

    /**
     * 标签详情
     * @param Request $request
     * @param $tag
     * @return mixed
     */
    public function detail(Request $request, $tag)
    {
    }


}