<?php

Route::get('/', 'PageController@home')->name('home');

//************************************* auth *******************************************
Auth::routes();

//************************************* dashboard *******************************************
Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.', 'namespace' => '\Dashboard'], function () {
    Route::get('/', 'DashboardController@home')->name('home');

    Route::group(['prefix' => '/admins', 'as' => 'admins.'], function () {
        Route::get('/', 'AdminController@index')->name('index');
        Route::get('/create', 'AdminController@create')->name('create');
        Route::post('/', 'AdminController@store')->name('store');
        Route::get('/{adminId}/edit', 'AdminController@edit')->name('edit');
        Route::put('/{adminId}', 'AdminController@update')->name('update');
        Route::delete('/{adminId}', 'AdminController@destroy')->name('destroy');
        Route::get('/{adminId}/permissions', 'AdminController@showPermissions')->name('showPermissions');
        Route::put('/{adminId}/permissions', 'AdminController@updatePermissions')->name('updatePermissions');
        Route::post('/{adminId}/active', 'AdminController@active')->name('active');
        Route::post('/{adminId}/deactive', 'AdminController@deactive')->name('deactive');
    });

    Route::group(['prefix' => '/tickets', 'as' => 'tickets.'], function () {
        Route::get('/', function (){return view('dashboard.tickets.index');})->name('index');
        Route::get('/create', function (){return view('dashboard.tickets.create');})->name('create');
        Route::get('/show', function (){return view('dashboard.tickets.show');})->name('show');
    });
});