<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/dashboard/guide', 'as' => 'dashboard.guide.', 'namespace' => '\Mwteam\Guide\App\Http\Controllers'], function () {
        Route::group(['prefix' => '/categories', 'as' => 'categories.'], function () {
            Route::get('/', 'GuideCategoryController@index')->name('index');
            Route::get('/create', 'GuideCategoryController@create')->name('create');
            Route::post('/', 'GuideCategoryController@store')->name('store');
            Route::get('/{guideCategory}', 'GuideCategoryController@show')->name('show');
            Route::get('/{guideCategory}/edit', 'GuideCategoryController@edit')->name('edit');
            Route::put('/{guideCategory}', 'GuideCategoryController@update')->name('update');
            Route::delete('/{guideCategory}', 'GuideCategoryController@destroy')->name('destroy');
        });

        Route::get('/', 'GuideController@index')->name('index');
        Route::get('/create', 'GuideController@create')->name('create');
        Route::post('/', 'GuideController@store')->name('store');
        Route::get('/{guide}', 'GuideController@show')->name('show');
        Route::get('/{guide}/edit', 'GuideController@edit')->name('edit');
        Route::put('/{guide}', 'GuideController@update')->name('update');
        Route::delete('/{guide}', 'GuideController@destroy')->name('destroy');
    });
});