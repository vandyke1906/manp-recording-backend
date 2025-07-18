<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // important for any auth later
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://mountapo-app.netlify.app','http://localhost:5173'], // ✅ NO "*"
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => ['Authorization', 'Content-Type', 'Content-Disposition'],
    'max_age' => 0,
    'supports_credentials' => false, // set to true only if cookies/auth
];
