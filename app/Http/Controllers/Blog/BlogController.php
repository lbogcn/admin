<?php

namespace app\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Article;

class BlogController extends Controller
{

    public function index($id)
    {
        $data = array(
            'article' => Article::with('contents')->findOrFail($id)
        );

        return view('blog.blog', $data);
    }

    public function column($alias)
    {
        dd($alias);
    }

}