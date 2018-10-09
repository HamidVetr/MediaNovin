<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('test', function (){return view('test');});
Route::get('test-index', function (){return view('test-index');});
Route::get('test-show', function (){return view('test-show');});

//************************************* auth *******************************************
Auth::routes();