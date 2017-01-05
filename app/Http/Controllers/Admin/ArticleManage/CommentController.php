<?php

namespace app\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ArticleComment;

class CommentController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => ArticleComment::withTrashed()->with('user')->paginate(),
        );

        return view('admin.article-manage.comment.index', $data);
    }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        $model = ArticleComment::findOrFail($id);

        $model->delete();

        return ApiResponse::buildFromArray();
    }

    /**
     * 恢复
     * @param $id
     * @return ApiResponse
     */
    public function restore($id)
    {
        $model = ArticleComment::withTrashed()->findOrFail($id);

        $model->restore();

        return ApiResponse::buildFromArray();
    }

}