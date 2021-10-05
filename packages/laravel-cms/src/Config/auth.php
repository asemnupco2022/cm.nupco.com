<?php
return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'members',
    ],

    'guards' => [
        'admin' => [
            'driver'   => 'session',
            'provider' => 'admins',
        ],

        'web' => [
            'driver'   => 'session',
            'provider' => 'members',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
//            'hash' => false,
        ],

        'member_api' => [
            'driver' => 'passport',
            'provider' => 'members',
//            'hash' => false,
        ],

        'admin_api' => [
            'driver' => 'passport',
            'provider' => 'admins',
//            'hash' => false,
        ],

    ],

    'providers' => [

        'members' => [
            'driver' => 'eloquent',
            'model' => config('lbs-laravel-cms.models.members'),
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model'  => config('lbs-laravel-cms.models.admins'),
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],

        'members' => [
            'provider' => 'members',
            'table'    => 'password_resets',
            'expire'   => 60,
        ],
    ],
];
