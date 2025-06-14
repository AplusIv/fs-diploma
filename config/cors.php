<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // 'paths' => ['login', 'logout', 'sanctum/csrf-cookie'], // add login/logout paths
    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'], // add login/logout paths


    'allowed_methods' => ['*'],

    // 'allowed_origins' => ['*'],
    'allowed_origins' => [env('FRONTEND_URL', '*')], // before guthub pages 

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // 'supports_credentials' => false,
    'supports_credentials' => true,


];
