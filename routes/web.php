<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('test', function (){return view('test');});
//************************************* auth *******************************************
Auth::routes();

//************************************ user panel **************************************
Route::group(['prefix' => '/panel', 'as' => 'panel.'], function () {
    Route::get('/', function (){
        return view('panel.home');
    })->name('home');
});