<?php

use App\Exceptions\AuthenticationException;
use App\Exceptions\ClientErrorException;
use App\Exceptions\ForbiddenErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Middleware\BeforeMiddleware;
use App\Http\Middleware\AfterMiddleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        /**
         * Custom
         */
        $middleware->group('web', [
            //
        ]);

        /**
         * Custom
         */
        $middleware->group('api', [
            BeforeMiddleware::class,
            ThrottleRequests::class . ':api',
            SubstituteBindings::class,
            AfterMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        function serverExceptionLog(string $channel, string $message, Throwable $exceptions): void
        {
            $requestindex = request()->locals ? request()->locals['requestIndex'] : date('YmdHis') . '-' . mt_rand();

            Log::channel('exception-log')->error("\nREQUEST_INDEX: {$requestindex}\nCHANNEL: {$channel}\nMESSAGE: {$message}\nEXCEPTION_MESSAGE: {$exceptions->getMessage()}\nEXCEPTION_CODE: {$exceptions->getCode()}\nEXCEPTION_FILE: {$exceptions->getFile()}\nEXCEPTION_LINE: {$exceptions->getLine()}\nEXCEPTION_TRACE:\n{$exceptions->getTraceAsString()}");
        }

        /**
         * ClientErrorException
         */
        $exceptions->render(function (ClientErrorException $e, $request) {
            $statusCode = 400;
            $message = $e->getMessage() ?: __('messages.http.error.client');

            serverExceptionLog('ClientErrorException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * NotFoundHttpException
         */
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            $statusCode = 404;
            $message = __('messages.http.not.found.request');

            serverExceptionLog('NotFoundHttpException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * MethodNotAllowedHttpException
         */
        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {
            $statusCode = 405;
            $message = __('messages.http.not.method.allowed');

            serverExceptionLog('MethodNotAllowedHttpException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * ServerErrorException
         */
        $exceptions->render(function (ServerErrorException $e, $request) {
            $statusCode = 500;
            $message = $e->getMessage() ?: __('messages.http.error.server');

            serverExceptionLog('ServerErrorException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * ErrorException
         */
        $exceptions->render(function (ErrorException $e, $request) {
            $statusCode = 400;
            $message = $e->getMessage() ?: __('messages.http.error.default');

            serverExceptionLog('ErrorException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            }

            return response()->view('pages.error', [
                'message' => $message,
                'error' => $e
            ], $statusCode);
        });

        /**
         * PDOException
         */
        $exceptions->render(function (PDOException $e, $request) {
            $statusCode = 500;
            $message = __('messages.http.error.pdo');

            serverExceptionLog('PDOException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });


        /**
         * ForbiddenErrorException
         */
        $exceptions->render(function (ForbiddenErrorException $e, $request) {
            $statusCode = 403;
            $message = $e->getMessage() ?: __('messages.http.forbidden');

            serverExceptionLog('ForbiddenErrorException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * AuthenticationException
         */
        $exceptions->render(function (AuthenticationException $e, $request) {
            $statusCode = 401;
            $message = $e->getMessage() ?: __('messages.http.authentication');

            serverExceptionLog('AuthenticationException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * ThrottleRequestsException
         */
        $exceptions->render(function (ThrottleRequestsException $e, $request) {
            $statusCode = 429;
            $message = __('messages.http.throttle');

            serverExceptionLog('ThrottleRequestsException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * BadMethodCallException
         */
        $exceptions->render(function (BadMethodCallException $e, $request) {
            $statusCode = 405;
            $message = $e->getMessage() ?: __('messages.http.bad.method');

            serverExceptionLog('BadMethodCallException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

        /**
         * ModelNotFoundException
         */
        $exceptions->render(function (ModelNotFoundException $e, $request) {
            $statusCode = 404;
            $message = __('messages.http.not.found.model');

            serverExceptionLog('ModelNotFoundException', $message, $e);

            if ($request->wantsJson()) {
                return Response::ErrorMacro($statusCode, $message, $e);
            } else {
                return response()->view('pages.error', [
                    'message' => $message,
                    'error' => $e
                ], $statusCode);
            }
        });

    })->create();
