<?php

Route::group(['middleware' => ['web', 'laralum.base'], 'namespace' => 'Laralum\Laralum\Controllers', 'as' => 'Laralum::'], function () {
    Route::get(config('laralum.base_url').'/login', 'LoginController@show')->name('login');
    Route::post(config('laralum.base_url').'/login', 'LoginController@login');
});
