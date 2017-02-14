<?php

namespace app\Components\UEditor;

/**
 * UE组件
 */
class UEditor
{

    private $config = array();

    /**
     * UEditor constructor.
     */
    public function __construct()
    {
        $this->config = config('ueditor');
    }

    /**
     * 调用Action
     * @param $action
     * @param $callback
     * @return mixed|string
     */
    public function callAction($action, $callback)
    {
        switch ($action) {
                // 获取配置
            case 'config':
                $result =  json_encode($this->config);
                break;

                // 上传图片
            case 'uploadimage':
                // 上传涂鸦
            case 'uploadscrawl':
                // 上传视频
            case 'uploadvideo':
                // 上传文件
            case 'uploadfile':
//                $result = include("action_upload.php");
                $result = $this->actionUpload();
                break;

                // 列出图片
            case 'listimage':
                // 列出文件
            case 'listfile':
//                $result = include("action_list.php");
                $result = $this->actionList();
                break;

                // 抓取远程文件
            case 'catchimage':
//                $result = include("action_crawler.php");
                $result = $this->actionCrawler();
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }

        if ($callback) {
            if (preg_match("/^[\w_]+$/", $callback)) {
                return htmlspecialchars($callback) . '(' . $result . ')';
            } else {
                return json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            return $result;
        }
    }

    private function actionUpload()
    {
    }

    private function actionList()
    {
    }

    private function actionCrawler()
    {
    }
}