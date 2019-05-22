<?php

Route::group([
        'middleware' => ['web', 'rb28dett.base', 'auth'],
        'namespace'  => 'RB28DETT\Profile\Controllers',
        'as'         => 'rb28dett_public::profile.',
    ], function () {
        Route::get('profile', 'ProfileController@publicProfile')->name('index');
        Route::get('profile/edit', 'ProfileController@publicEditProfile')->name('edit');
        Route::post('profile/edit', 'ProfileController@PublicUpdateProfile')->name('update');
    });

Route::group([
        'middleware' => ['web', 'rb28dett.base', 'rb28dett.auth'],
        'prefix'     => config('rb28dett.settings.base_url'),
        'namespace'  => 'RB28DETT\Profile\Controllers',
        'as'         => 'rb28dett::profile.',
    ], function () {
        Route::get('profile', 'ProfileController@profile')->name('index');
        Route::get('profile/edit', 'ProfileController@editProfile')->name('edit');
        Route::post('profile/edit', 'ProfileController@updateProfile')->name('update');
    });
