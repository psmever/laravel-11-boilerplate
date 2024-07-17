<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class RequestLocalsMergeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        Request::macro('LocalsMergeMacro', function (string $mergeName, string $mergeValue) {
            $this->merge(["locals" => array_merge((array)$this->locals, [$mergeName => $mergeValue])]);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
