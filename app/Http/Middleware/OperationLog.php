<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Zhuzhichao\IpLocationZh\Ip;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $shouldOperation = false)
    {
        if ($shouldOperation || app()->environment('local')) {
            // $monolog = Log::getLogger();    // laravel >= 5.6
            $monolog = Log::getMonolog();      // laravel <= 5.5
            $logHandlerBak = $monolog->popHandler();
            Log::useDailyFiles(storage_path('logs/operation.log', 180, 'debug'));

            $userInfo = ['id' => 1, 'username' => 'admin', 'realname' => 'god'];
            $userString = join(array_filter($userInfo), ' ');
            $uri = $request->path();
            $method = $request->method();
            $userAgent = $request->header('User-Agent');
            $ip = $request->ip();
            $ipInfo = join(array_unique(array_filter(Ip::find($ip))), ' ');
            $queryString = http_build_query($request->except(['password', 'token']));
            $logMsg = join([$userString, $method . ' ' . $uri . ' ' . $queryString, $userAgent, $ip, $ipInfo], ' | ');

            Log::info($logMsg.PHP_EOL);

            $monolog->popHandler();
            $monolog->pushHandler($logHandlerBak);
        }

        return $next($request);
    }
}
