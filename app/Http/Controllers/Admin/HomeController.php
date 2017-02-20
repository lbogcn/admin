<?php

namespace App\Http\Controllers\Admin;

use app\Components\UEditor\UEditor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * 后台入口
     */
    public function index()
    {
        return view('admin.home');
    }

    public function ueditor(Request $request)
    {
        $action = $request->input('action');
        $callback = $request->input('callback');

        return (new UEditor())->callAction($action, $callback);
    }

    /**
     * SQL分析
     */
    public function sqlExplain()
    {
        // 非Debug模式不允许访问
        if (!config('app.debug')) {
            return;
        }

        $types = array(
            'system',
            'const',
            'eq_ref',
            'ref',
            'fulltext',
            'ref_or_null',
            'index_merge',
            'unique_subquery',
            'index_subquery',
            'range',
            'index',
//                'ALL',
        );

        $results = array();

        while ($log = \RedisClient::connection()->rpop('get_query_log')) {
            $logHash = json_decode($log, true);

            if (empty($logHash['query'])) {
                continue;
            }

            $explains = \DB::select("explain {$logHash['query']}", $logHash['bindings']);

            foreach ($explains as $explain) {
                if (!in_array($explain->type, $types)) {
                    $results[] = $logHash;
                    break;
                }
            }
        }

        dd($results);
    }


}