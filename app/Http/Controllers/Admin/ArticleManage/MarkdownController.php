<?php

namespace App\Http\Controllers\Admin\ArticleManage;

use App\Components\Qiniu;
use App\Http\Controllers\Controller;
use App\Models\ArticleColumn;
use App\Models\ArticleTag;

/**
 * Markdown
 * @menu create Markdown写文章
 * @nodeTitle Markdown
 * @nodeName create 写文章
 * @nodeName store 保存
 * @nodeName show 详情编辑
 * @nodeName preview 预览
 * @nodeName update 更新
 */
class MarkdownController extends Controller
{

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

        return view('admin.article-manage.markdown.create', $data);
    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function preview()
    {

    }

}