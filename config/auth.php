<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // ✅ Tenant guard must be inside 'guards'
        'tenant' => [
            'driver' => 'session',
            'provider' => 'tenants',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // ✅ Tenant provider
        'tenants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Tenant::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Optional: if you ever want tenant password reset
        'tenants' => [
            'provider' => 'tenants',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
