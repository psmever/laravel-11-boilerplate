<?php

return [

    /*
    |--------------------------------------------------------------------------
    | App Constans
    |--------------------------------------------------------------------------
    */

    'config' => [
        'appEnv' => env('APP_ENV', 'local'),
        'client-code' => [
            'Syndication' => 'C10010'
        ],
        'client-token' => [
            'Syndication' => env('SYNDICATION_TOKEN', null),
        ]
    ],
];
