<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Facade;

class PolyHelperFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'App\Helpers\PolyHelper';
    }
}
