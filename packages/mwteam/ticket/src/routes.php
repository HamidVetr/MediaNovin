<?php

Route::group(['prefix' => '/dashboard', 'as' => 'dashboard.'], function () {
    Route::group(['prefix' => '/tickets', 'as' => 'tickets.', 'namespace' => '\Mwteam\Ticket\Controllers'], function () {
        Route::get('/', 'TicketController@index')->name('index');
        Route::get('/create', 'TicketController@create')->name('create');
        Route::post('/', 'TicketController@store')->name('store');
        Route::get('/{ticketId}', 'TicketController@show')->name('show');
        Route::put('/{ticketId}', 'TicketController@reply')->name('reply');
        Route::delete('/{ticketId}', 'TicketController@destroy')->name('destroy');
        Route::delete('/{ticketId}/{messageId}', 'TicketController@destroyMessage')->name('destroyMessage');
    });
});