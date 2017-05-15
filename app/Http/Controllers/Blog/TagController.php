<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;

class TagController extends Controller
{

    /**
     * 标签详情
     * @param $tag
     * @return mixed
     */
    public function detail($tag)
    {
        $data = array(
            'pageName' => $tag,
            'tag' => $tag,
            'columnId' => null,
        );

        return view('jiestyle2.tag', $data);
    }


}