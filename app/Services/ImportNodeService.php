<?php

namespace App\Services;

use App\Models\AdminNode;
use App\Providers\RouteServiceProvider;

class ImportNodeService
{

    public function handle()
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
    }

}