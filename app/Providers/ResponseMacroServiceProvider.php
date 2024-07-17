<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Request;
use stdClass;
use Throwable;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(Request $request): void
    {
        /**
         * 성공 No Contents Render Macro
         */
        Response::macro('SuccessNoContentMacro', function () {
            $response = new stdClass();
            return Response()->json($response, 204);
        });

        /**
         * 결과 커스텀 하게 사용.
         */
        Response::macro('SuccessMacro', function ($paramData = NULL, $message = null, int $statusCode = 200) use ($request) {

            if (is_array($paramData) && empty($paramData)) {
                return Response()->json([], 204);
            }

            if (is_array($paramData)) {
                return Response()->json($paramData, $statusCode);
            }

            return Response()->json(['message' => $message ?: __('messages.http.success')], $statusCode);
        });

        /**
         * 기본 Error Render Macro.
         */
        Response::macro('ErrorMacro', function (int $statusCode = 400, string $message = null, ?Throwable $errors = NULL) use ($request) {
            $response = [
                'message' => $message ?: __('messages.http.error.default')
            ];

            if (App::environment(['local']) && !empty($errors)) {
                $response['error'] = [
                    'Message' => $errors->getMessage(),
                    'Code' => $errors->getCode(),
                    'File' => $errors->getFile(),
                    'Line' => $errors->getLine(),
                    'Trace' => $errors->getTrace(),
                    'Previous' => $errors->getPrevious(),
                    'TraceAsString' => $errors->getTraceAsString(),
                ];
            }

            return Response()->json($response, $statusCode);
        });
    }
}
