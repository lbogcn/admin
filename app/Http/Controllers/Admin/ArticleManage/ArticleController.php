<?php

namespace App\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Components\CacheName;
use App\Components\Qiniu;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleColumn;
use App\Models\ArticleTag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => Article::paginate(),
        );

        return view('admin.article-manage.article.index', $data);
    }

    /**
     * 写文章
     * @param Qiniu $qiniu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Qiniu $qiniu)
    {
        $callbackUrl = config('qiniu.callback_ueditor');
        $uploadToken = $qiniu->uploadToken($callbackUrl);
        $columns = ArticleColumn::homeColumns();
        $tags = ArticleTag::getAllTag();

        $data = array(
            'navLocation' => action('\\' . self::class . '@index'),
            'uploadToken' => $uploadToken,
            'columns' => $columns,
            'tags' => $tags
        );

        return view('admin.article-manage.article.create', $data);
    }

    /**
     * 保存文章
     * @param Request $request
     * @return string
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $status = implode(',', [Article::STATUS_RELEASE, Article::STATUS_DRAFT]);
        $type = implode(',', [Article::TYPE_ARTICLE, Article::TYPE_PAGE]);
        $this->validate($request, array(
            'title' => ['required', 'max:30'],
            'content' => ['required'],
            'status' => ['required', "in:{$status}"],
            'type' => ['required', "in:{$type}"],
            'tag' => ['array'],
            'column' => ['array']
        ));

        $data = $request->only(['title', 'status', 'type']);
        $data['author'] = \Auth::guard()->user()->username;
        $data['user_id'] = \Auth::guard()->user()->getAuthIdentifier();
        $data['excerpt'] = str_excerpt($request->input('content'), 250);
        $column = $request->input('column');
        $tag = $request->input('tag');
        $content = $request->input('content');

        Article::add($data, $column, $tag, $content);
        Article::clearCache();

        return ApiResponse::buildFromArray();
    }

    /**
     * 上架
     * @param $id
     * @return ApiResponse
     */
    public function up($id)
    {
        Article::up($id);
        Article::clearCache();

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
        Article::clearCache();

        return ApiResponse::buildFromArray();
    }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        Article::del($id);
        Article::clearCache();

        return ApiResponse::buildFromArray();
    }

}