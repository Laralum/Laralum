<?php

Route::group(['middleware' => ['web', 'laralum.base'], 'prefix' => config('laralum.settings.base_url'), 'namespace' => 'Laralum\Laralum\Controllers', 'as' => 'laralum::'], function () {
    Route::get('/', 'LaralumController@index')->name('index');
    Route::get('/login', 'LoginController@show')->name('login');
    Route::post('/login', 'LoginController@login');
});
