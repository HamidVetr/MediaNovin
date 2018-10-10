<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/dashboard/blog', 'as' => 'dashboard.blog.', 'namespace' => '\Mwteam\Blog\App\Http\Controllers'], function () {
        Route::group(['prefix' => '/articles', 'as' => 'articles.'], function () {
            Route::get('/', 'BlogArticleController@index')->name('index');
            Route::get('/create', 'BlogArticleController@create')->name('create');
            Route::post('/', 'BlogArticleController@store')->name('store');
            Route::get('/{blogArticle}', 'BlogArticleController@show')->name('show');
            Route::get('/{blogArticle}/edit', 'BlogArticleController@edit')->name('edit');
            Route::put('/{blogArticle}', 'BlogArticleController@update')->name('update');
            Route::delete('/{blogArticle}', 'BlogArticleController@destroy')->name('destroy');
            Route::post('/upload/inline', 'BlogArticleController@uploadInline')->name('uploadInline');
        });

        Route::group(['prefix' => '/categories', 'as' => 'categories.'], function () {
            Route::resource('/', 'BlogCategoryController');
        });

        Route::group(['prefix' => '/tags', 'as' => 'tags.'], function () {
            Route::resource('/', 'BlogTagController');
        });

        Route::group(['prefix' => '/comments', 'as' => 'comments.'], function () {
            Route::get('/approve/{comment}', 'BlogCommentController@approve');
            Route::get('/reply/{comment}', 'BlogCommentController@reply');
            Route::resource('/', 'BlogCommentController');
        });
    });
});