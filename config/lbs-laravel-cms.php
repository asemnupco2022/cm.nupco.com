<?php

/*
 * You can place your custom package configuration in here.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Application settings
    |--------------------------------------------------------------------------
    | You n change the subdomain name for the admin
    |
    |
    |
    */

    'application'=>[
        'admin_route_domain'=>'nupco',
        'ssl'=>'true',
        'member_api_prefix'=>'lcrm-api',
        'admin_api_prefix'=>'lcrm-admin-api',
        'default_email'=>'developer@laravelcms.com',
        'imageMedia'=>['png','svg','jpg','jpeg'],
        'videoMedia'=>['mp4','mov','flv','avi','mkv'],
        'storage'=>'local' // s3  or public
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    | trust me you don't wanna mess with these settings, unless you are so pro.
    | Add the model you want to use.
    |
    */

    'models' => [
        'admins' => rifrocket\LaravelCms\Models\LbsAdmin::class,
        'members' =>  rifrocket\LaravelCms\Models\LbsMember::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Exception Handling Views
    |--------------------------------------------------------------------------
    | custom http error handler
    | you can customize these views

    */

    'exception'=>[
        'admin_exception_views'=>base_path() . '/vendor/rifrocket/laravelcrm/src/Resources/views/admin_docs/errors',
        'member_exception_views'=>base_path() . '/vendor/rifrocket/laravelcrm/src/Resources/views/members_docs/errors',
    ],

    'passport_api_token'=>[
        'api_personal_access_client_secret'=>env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET','aA8vhwndFLZn8ajUqkHkjzEfDrd5c9aDFaDM9mPe'),
        'api_personal_access_client_id'=>env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID','5'),
        'api_forget_password_otp_length'=>6,
    ]

];
