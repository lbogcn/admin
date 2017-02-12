<?php

namespace app\Http\Middleware;

use App\Models\ArticleColumn;
use Closure;
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
        $about = array(
            'column_name' => '关于',
            'url' => '/about'
        );

        foreach ($columns as $column) {
            $nav = array(
                'column_name' => $column['column_name'],
                'url' => '/column/' . $column['alias'],
            );

            $navs[] = $nav;
        }

        array_unshift($navs, $home);
        array_push($navs, $about);

        foreach ($navs as &$column) {
            if ($column['url'] == $request->getPathInfo()) {
                $column['active'] = true;
            } else {
                $column['active'] = false;
            }
        }

        View::share('navs', $navs);
    }
}