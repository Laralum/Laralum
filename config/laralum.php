<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laralum settings
    |--------------------------------------------------------------------------
    |
    | This are the base settings for laralum, make sure it's all correct.
    */
    'settings' => [
        'base_url'  => '/administration',
        'api_url'   => '/api',
    ],

    /*
    |--------------------------------------------------------------------------
    | Users settings
    |--------------------------------------------------------------------------
    |
    | This are the base settings for users, make sure it's all correct.
    */
    'superadmins' => [
        'example@email.com',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Superadmins bypass hasPermission
    |--------------------------------------------------------------------------
    |
    | This determines if the superadmins can bypass the $user->hasPermission()
    */
    'superadmin_bypass_haspermission' => false,

    /*
    |--------------------------------------------------------------------------
    | Languages settings
    |--------------------------------------------------------------------------
    |
    | This are the current languages supported on laralum.
    */
    'languages' => ['en', 'es', 'ca', 'fr', 'de', 'it', 'ru'],

    /*
    |--------------------------------------------------------------------------
    | Laralum menu injector
    |--------------------------------------------------------------------------
    |
    | This array will be injected into the laralum menu, you can add everything
    | you want on it and it will be available at any page on laralum's menu.
    */
    'menu' => [
        [
            'title' => 'Other',
            'items' => [
                [
                    'text' => 'Homepage',
                    'link' => '/',
                ],
            ],
        ],
    ],

];
