<?php
Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.'], function () {
        Route::group(['prefix' => '/broadcast-email', 'as' => 'broadcastEmail.', 'namespace' => '\Mwteam\BroadcastEmail\Controllers'], function () {
            Route::get('/', 'BroadcastEmailController@index')->name('index');
            Route::get('/create', 'BroadcastEmailController@create')->name('create');
            Route::post('/', 'BroadcastEmailController@store')->name('store');
            Route::get('/{emailId}', 'BroadcastEmailController@show')->name('show');
        });
    });
});