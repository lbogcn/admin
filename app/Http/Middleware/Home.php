<?php

namespace app\Http\Middleware;

use App\Models\ArticleColumn;
use Closure;
use View;

class Home
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
        $this->shareViewData();

        return $next($request);
    }

    /**
     * 视图数据共享
     */
    private function shareViewData()
    {
        $share = array(
            'columns' => ArticleColumn::homeColumns()
        );

        View::share('share', $share);
    }
}