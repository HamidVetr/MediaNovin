<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('/dashboard', 'DashboardController@home')->name('dashboard');
Auth::routes();


