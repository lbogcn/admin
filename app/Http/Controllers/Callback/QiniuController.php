<?php

namespace App\Http\Controllers\Callback;

use App\Components\Qiniu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QiniuController extends Controller
{


    /**
     * UEditor上传回调
     * @param Request $request
     * @param Qiniu $qiniu
     * @return array
     */
    public function ueditor(Request $request, Qiniu $qiniu)
    {
        $callbackBody = $request->getContent();
        $contentType = $request->server('HTTP_CONTENT_TYPE');
        $authorization = $request->server('HTTP_AUTHORIZATION');
        $url = config('qiniu.callback_ueditor');

        if ($qiniu->verifyCallback($contentType, $authorization, $url, $callbackBody)) {
            $callbackBodyHash = json_decode($callbackBody, true);

            $url = $qiniu->moveToPublic($callbackBodyHash);

            return array('state' => 'SUCCESS', 'url' => $url);
        } else {
            return array('state' => 'FAILURE');
        }
    }

}