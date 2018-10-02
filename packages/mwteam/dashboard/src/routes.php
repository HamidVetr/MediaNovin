<?php
Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.', 'namespace' => '\Mwteam\Dashboard\Controllers'], function () {
        Route::get('/', 'DashboardController@home')->name('home');

        Route::group(['prefix' => '/admins', 'as' => 'admins.'], function () {
            Route::get('/', 'AdminController@index')->name('index');
            Route::get('/create', 'AdminController@create')->name('create');
            Route::post('/', 'AdminController@store')->name('store');
            Route::get('/{adminId}/edit', 'AdminController@edit')->name('edit');
            Route::put('/{adminId}', 'AdminController@update')->name('update');
            Route::get('/{adminId}/permissions', 'AdminController@showPermissions')->name('showPermissions');
            Route::put('/{adminId}/permissions', 'AdminController@updatePermissions')->name('updatePermissions');
            Route::post('/{adminId}/active', 'AdminController@active')->name('active');
            Route::post('/{adminId}/deactive', 'AdminController@deactive')->name('deactive');
        });
    });

    Route::group(['prefix' => '/assets', 'as' => 'assets.', 'namespace' => '\Mwteam\Dashboard\Controllers'], function () {
        Route::group(['prefix' => '/css', 'as' => 'css.'], function () {

        });

        Route::group(['prefix' => '/js', 'as' => 'js.'], function () {

        });
    });
});