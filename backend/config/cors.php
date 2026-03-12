<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => explode(',', env('CORS_ALLOW_ORIGINS', '*')),
    'allowed_headers' => ['*'],
    'supports_credentials' => true,
];