<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use RedisClient;

class DBLog
{

    /** 是否启用查询日志 @var bool */
    private $isEnableQueryLog = false;

    /**
     * DBLog constructor.
     */
    public function __construct()
    {
        // debug模式时记录SQL日志
        if (config('app.debug')) {
            DB::connection()->enableQueryLog();
            $this->isEnableQueryLog = true;
        }
    }

    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Perform any final actions for the request lifecycle.
     * @param $request
     * @param $response
     */
    public function terminate($request, $response)
    {
        if ($this->isEnableQueryLog) {
            $logs = DB::getQueryLog();

            foreach ($logs as $log) {
                RedisClient::connection()->lpush('get_query_log', json_encode($log, JSON_UNESCAPED_UNICODE));
            }
        }
    }

}