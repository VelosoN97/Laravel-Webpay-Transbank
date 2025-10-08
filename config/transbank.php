<?php

return [
    'environment' => env('TRANSBANK_ENV', 'integration'),
    'webpay' => [
        'commerce_code' => env('WEBPAY_COMMERCE_CODE', '597055555532'),
        'api_key' => env('WEBPAY_API_KEY', '579B532A7440BB0C0E0F2A9F9A2FA3F9'),
    ],
];