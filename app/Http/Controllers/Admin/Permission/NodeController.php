<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\AdminNode;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

/**
 * 节点管理
 * @nodeTitle 权限-节点管理
 * @node index 节点列表
 * @node store 保存节点
 * @node update 更新节点
 * @node destroy 删除节点
 * @node import 一键导入自动更新节点
 */
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

    /**
     * 一键导入自动更新节点
     */
    public function import()
    {
        /** @var \Illuminate\Routing\Route $route */
        $route = null;
        $nodes = [];
        $repeatCtls = [];
        $namespace = app()->getProvider(RouteServiceProvider::class)->getNamespace();

        foreach (\Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (!isset($action['controller'])) {
                continue;
            }

            @list($ctl, $act) = explode('@', $action['controller']);
            if (!($ctl && $act) || !class_exists($ctl)) {
                continue;
            }

            if (isset($repeatCtls[$ctl])) {
                continue;
            }

            //通过反射获取类的注释
            $reflection = new \ReflectionClass($ctl);
            $docs = explode("\n", str_replace(["\r\n", "\r"], "\n", $reflection->getDocComment()));
            foreach ($docs as $doc) {
                $doc = preg_replace("/\s(?=\s)/", "\\1", trim($doc, " \t\n\r\0\x0B*"));

                if (starts_with($doc, '@node')) {

                    @list(, $method, $nodeName) = explode(' ', $doc);

                    if (!($method && $nodeName) || !$reflection->hasMethod($method)) {
                        continue;
                    }

                    $nodes[substr($ctl, strlen($namespace) + 1, strlen($ctl)) . '@' . $method] = $nodeName;
                }
            }
        }

        /** @var AdminNode $node */
        $node = null;
        foreach (AdminNode::get() as $node) {
            if (isset($nodes[$node->route])) {
                $node->node = $nodes[$node->route];
                $node->saveOrFail();
                unset($nodes[$node->route]);
            }
        }

        if (count($nodes) > 0) {
            $newNodes = array();
            foreach ($nodes as $route => $node) {
                $newNodes[] = array(
                    'route' => $route,
                    'node' => $node
                );
            }

            AdminNode::insert($newNodes);
        }

        return ApiResponse::buildFromArray();
    }

}