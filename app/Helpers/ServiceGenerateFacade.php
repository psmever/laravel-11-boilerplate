<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Facade;

class ServiceGenerateFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'App\Helpers\ServiceGenerate';
    }
}
