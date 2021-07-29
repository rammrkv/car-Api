<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'user_details',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'user_details',
        ],
    ],

    'providers' => [
        'user_details' => [
            'driver' => 'eloquent',
            'model' => \App\Models\UserDetails::class
        ]
    ]
];
