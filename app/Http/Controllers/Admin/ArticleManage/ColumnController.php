<?php

namespace app\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\ArticleColumn;
use Illuminate\Http\Request;

class ColumnController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => ArticleColumn::paginate(),
        );

        return view('admin.article-manage.column.index', $data);
    }

    /**
     * 新增
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'column_name' => ['required', 'unique:article_columns', 'max:8'],
            'weight' => ['required', 'numeric', 'max:100', 'min:0'],
            'is_show' => ['required', 'in:1,2'],
        ));

        ArticleColumn::create($request->only(['column_name', 'weight', 'is_show']));

        return ApiResponse::buildFromArray();
    }

    public function update(Request $request, $id)
    {
        $model = ArticleColumn::findOrFail($id);

        $this->validate($request, array(
            'column_name' => ['required', "unique:article_columns,column_name,{$id}", 'max:8'],
            'weight' => ['required', 'numeric', 'max:100', 'min:0'],
            'is_show' => ['required', 'in:1,2'],
        ));

        $data = $request->only(['column_name', 'weight', 'is_show']);
        $model->update($data);

        return ApiResponse::buildFromArray();
    }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        $model = ArticleColumn::findOrFail($id);

        $model->delete();

        return ApiResponse::buildFromArray();
    }

}