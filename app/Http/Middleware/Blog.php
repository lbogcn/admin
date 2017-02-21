<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\ArticleColumn;
use App\Models\ArticleTag;
use Closure;
use Illuminate\Pagination\LengthAwarePaginator;
use View;

class Blog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $this->shareNav($request);
        $this->shareStat();

        // 修改博客默认分页样式
        LengthAwarePaginator::defaultView('paginator.qzhai-no7');

        return $next($request);
    }

    /**
     * 栏目导航
     * @param  \Illuminate\Http\Request $request
     */
    private function shareNav($request)
    {
        $columns = ArticleColumn::homeColumns();
        $home = array(
            'column_name' => '首页',
            'url' => '/'
        );

        foreach ($columns as $column) {
            $nav = array(
                'column_name' => $column['column_name'],
                'url' => '/column/' . $column['alias'],
            );

            $navs[] = $nav;
        }

        array_unshift($navs, $home);

        foreach ($navs as &$column) {
            if ($column['url'] == $request->getPathInfo()) {
                $column['active'] = true;
            } else {
                $column['active'] = false;
            }
        }

        View::share('navs', $navs);
    }

    /**
     * 数据统计
     */
    private function shareStat()
    {
        $articleTotal = Article::getTotal();
        $columnTotal = ArticleColumn::getTotal();
        $tagTotal = ArticleTag::getTotal();

        $stat = array(
            'articleTotal' => $articleTotal,
            'columnTotal' => $columnTotal,
            'tagTotal' => $tagTotal,
        );

        View::share('stat', $stat);
    }
}