<?php

namespace App\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Qiniu\Auth;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $auth = new Auth(config('qiniu.access_key'), config('qiniu.secret_key'));
        $bucket = 'lbog-buff';
        $policy = array(
            'callbackUrl' => 'http://callback.lbog.cn/qiniu',
            'callbackBody' => json_encode(array(
                'key' => '$(key)',
                'etag' => '$(etag)',
                'ext' => '$(ext)',
            ))
        );
        $uploadToken = $auth->uploadToken($bucket, null, 3600, $policy);

        $data = array(
            'navLocation' => action('\\' . self::class . '@index'),
            'uploadToken' => $uploadToken
        );

        return view('admin.article-manage.article.create', $data);
    }

    public function store()
    {
        return __FUNCTION__;
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

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        Article::del($id);

        return ApiResponse::buildFromArray();
    }

}