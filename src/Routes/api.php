<?php

Route::group([
        'middleware' => [
            'web', 'laralum.base', 'laralum.auth', 'throttle:60,1',
        ],
        'prefix'    => config('laralum.settings.api_url'),
        'namespace' => 'Laralum\Laralum\Controllers',
        'as'        => 'laralum_api::',
    ], function () {
        Route::post('/save_menu_action', 'LaralumController@saveMenuAction')->name('save_menu_action');
    });
