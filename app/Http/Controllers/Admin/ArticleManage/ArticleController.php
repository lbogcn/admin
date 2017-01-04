<?php

namespace app\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{

    public function index()
    {
        $data = array(
            'paginate' => Article::paginate(),
        );

        return view('admin.article-manage.article.index', $data);
    }

    /**
     * 上架
     * @param $id
     * @return ApiResponse
     */
    public function up($id)
    {
        Article::up($id);

        return ApiResponse::buildFromArray();
    }

    /**
     * 下架
     * @param $id
     * @return ApiResponse
     */
    public function down($id)
    {
        Article::down($id);

        return ApiResponse::buildFromArray();
    }

    public function destroy($id)
    {
        Article::del($id);

        return ApiResponse::buildFromArray();
    }

}