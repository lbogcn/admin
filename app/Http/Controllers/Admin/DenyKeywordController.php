<?php

namespace App\Http\Controllers\Admin;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\DenyKeyword;
use Illuminate\Http\Request;

/**
 * 禁用词管理
 * @menu index 禁用词管理
 * @nodeTitle 禁用词管理
 * @nodeName index 列表
 * @nodeName store 保存
 * @nodeName destroy 删除
 */
class DenyKeywordController extends Controller
{

    public function __construct(Request $request)
    {
        if ($request->exists('keyword')) {
            $keyword = trim($request->input('keyword'));
            $request->request->set('keyword', $keyword);
            $request->query->set('keyword', $keyword);
        }
    }

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => DenyKeyword::paginate(),
        );

        return view('admin.deny-keyword.index', $data);
    }

    /**
     * 新增
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'keyword' => ['required', 'max:16', 'unique:deny_keywords'],
        ));

        DenyKeyword::create($request->only(['keyword']));

        return ApiResponse::buildFromArray();
    }

    /**
     * 删除
     * @param $keyword
     * @return ApiResponse
     */
    public function destroy($keyword)
    {
        DenyKeyword::where('keyword', $keyword)
            ->delete();

        return ApiResponse::buildFromArray();
    }

}