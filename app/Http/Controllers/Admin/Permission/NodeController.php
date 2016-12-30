<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\AdminNode;
use Illuminate\Http\Request;

class NodeController extends Controller
{

    /**
     * 节点列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => AdminNode::paginate()
        );

        return view('admin.permission.node.index', $data);
    }

    /**
     * 保存
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'node' => ['required', 'min:1', 'max:12'],
            'route' => ['max:255'],
        ));

        AdminNode::create($request->only(['node', 'route']));

        return ApiResponse::buildFromArray();
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return ApiResponse
     */
    public function update(Request $request, $id)
    {
        $model = AdminNode::findOrFail($id);

        $this->validate($request, array(
            'node' => ['required', 'min:1', 'max:12'],
            'route' => ['max:255'],
        ));

        $data = $request->only(['node', 'route']);
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
        $model = AdminNode::findOrFail($id);

        \DB::beginTransaction();
        $model->delete();
        $model->roles()->detach();
        \DB::commit();

        return ApiResponse::buildFromArray();
    }

}