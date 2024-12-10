<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default CORS Settings
    |--------------------------------------------------------------------------
    |
    | You can customize the CORS settings here. The default options should work
    | for most applications, but feel free to tweak them if needed.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true
];