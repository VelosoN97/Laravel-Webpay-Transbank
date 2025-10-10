<?php

return [
    'environment' => env('TRANSBANK_ENV', 'integration'),

    'webpay' => [
        // Código de comercio oficial de integración (no cambia)
        'commerce_code' => env('WEBPAY_COMMERCE_CODE', '597055555532'),

        // API Key oficial de integración (no cambia)
        'api_key' => env('WEBPAY_API_KEY', '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C'),
    ],
];
