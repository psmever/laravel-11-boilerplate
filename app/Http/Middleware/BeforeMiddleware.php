<?php

namespace App\Http\Middleware;

use Closure;
use ErrorException;
use Illuminate\Http\Request;
use Log;
use Route;
use Symfony\Component\HttpFoundation\Response;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws ErrorException
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestIndex = date('YmdHis') . '-' . mt_rand();

        // request log
        $environment = config('constans.config.appEnv');
        $request_ip = request()->ip();
        $current_url = url()->current();
        $logRouteAction = Route::currentRouteAction();
        $logRouteName = Route::currentRouteName();
        $method = request()->method();
        $logHeaderInfo = json_encode(request()->header());
        $logBodyInfo = json_encode(request()->all());

        $log = <<<EOF

REQUEST_INDEX: $requestIndex
ENV: $environment
RequestIP: $request_ip
Current_url: $current_url
RouteAction: $logRouteAction
RouteName: $logRouteName
Method: $method
Header: $logHeaderInfo
Body: $logBodyInfo

EOF;
        Log::channel('request-log')->info($log);

        if (!$request->wantsJson()) {
            throw new ErrorException(__('messages.http.wants.json'));
        }

        $exceptionRouteName = [''];
        $clientCode = $request->header('client-code');


        if (!in_array(Route::currentRouteName(), $exceptionRouteName)) {
            if (empty($clientCode)) {
                throw new ErrorException(__('messages.http.empty.client.code'));
            }

            if (empty(array_search($clientCode, config('constans.config.client-code')))) {
                throw new ErrorException(__('messages.http.bad.client.code'));
            }
        }

        $request->LocalsMergeMacro('requestClientCode', $clientCode);
        $request->LocalsMergeMacro('requestIndex', $requestIndex);

        // Perform action
        return $next($request);
    }
}
