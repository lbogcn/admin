<?php

namespace App\Http\Controllers\Admin\ArticleManage;

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
     * 恢复
     * @param $id
     * @return ApiResponse
     */
    public function restore($id)
    {
        /** @var ArticleComment $model */
        $model = ArticleComment::withTrashed()->findOrFail($id);

        $model->status = ArticleComment::STATUS_NORMAL;

        $model->saveOrFail();

        return ApiResponse::buildFromArray();
    }

    /**
     * 恢复
     * @param $id
     * @return ApiResponse
     */
    public function deny($id)
    {
        /** @var ArticleComment $model */
        $model = ArticleComment::withTrashed()->findOrFail($id);

        $model->status = ArticleComment::STATUS_DENY;

        $model->saveOrFail();

        return ApiResponse::buildFromArray();
    }

}