<?php

Route::group(['middleware' => ['web', 'laralum.base'], 'prefix' => config('laralum.base_url'), 'namespace' => 'Laralum\Laralum\Controllers', 'as' => 'Laralum::'], function () {
    Route::get('/', 'LoginController@index')->name('index');
    Route::get('/login', 'LoginController@show')->name('login');
    Route::post('/login', 'LoginController@login');
});
