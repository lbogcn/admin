<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class Authenticate extends \Illuminate\Auth\Middleware\Authenticate
{

    /**
     * 重写授权失败时跳转地址
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param array ...$guards
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($guards);

            return $next($request);
        } catch (AuthenticationException $e) {
            $guard = current($guards);

            return redirect("{$guard}/login");
        }
    }

}