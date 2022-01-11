<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel money
     |--------------------------------------------------------------------------
     | https://github.com/cknow/laravel-money
     */
    'locale' => config('app.locale', 'pt_BR'),
    'defaultCurrency' => config('app.currency', 'BRL'),
    'defaultFormatter' => null,
    'currencies' => [
        'iso' => 'all',
        'bitcoin' => 'all',
        'custom' => [
            // 'MY1' => 2,
            // 'MY2' => 3
        ],
    ],
];
