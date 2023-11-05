<?php

// config/payments.php

return [
    'default' => env('PAYMENT_GATEWAY', 'stripe'),

    'stripe' => [
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // ... other gateway configurations ...
];
