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

}