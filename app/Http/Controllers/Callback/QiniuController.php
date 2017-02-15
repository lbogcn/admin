<?php

namespace App\Http\Controllers\Callback;

use App\Http\Controllers\Controller;

class QiniuController extends Controller
{


    public function index()
    {
        return file_get_contents('php://input');
    }

}