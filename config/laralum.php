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
    | Laralum languages
    |--------------------------------------------------------------------------
    |
    | This are the current languages supported on laralum.
    */
    'languages' => ['en', 'es', 'ca', 'de', 'it'],

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
