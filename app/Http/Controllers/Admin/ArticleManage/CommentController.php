<?php

namespace App\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ArticleComment;

/**
 * 评论管理
 * @nodeTitle 评论管理
 * @node index 列表
 * @node restore 恢复
 * @node deny 禁用
 */
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
     * 禁用
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