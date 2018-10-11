<?php

Route::get('/', 'PageController@home')->name('home');

//************************************* auth *******************************************
Auth::routes();