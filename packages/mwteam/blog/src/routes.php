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
            Route::get('/', 'BlogCategoryController@index')->name('index');
            Route::get('/create', 'BlogCategoryController@create')->name('create');
            Route::post('/', 'BlogCategoryController@store')->name('store');
            Route::get('/{blogCategory}', 'BlogCategoryController@show')->name('show');
            Route::get('/{blogCategory}/edit', 'BlogCategoryController@edit')->name('edit');
            Route::put('/{blogCategory}', 'BlogCategoryController@update')->name('update');
            Route::delete('/{blogCategory}', 'BlogCategoryController@destroy')->name('destroy');
        });

        Route::group(['prefix' => '/tags', 'as' => 'tags.'], function () {
            Route::get('/', 'BlogTagController@index')->name('index');
            Route::get('/create', 'BlogTagController@create')->name('create');
            Route::post('/', 'BlogTagController@store')->name('store');
            Route::get('/{blogTag}', 'BlogTagController@show')->name('show');
            Route::get('/{blogTag}/edit', 'BlogTagController@edit')->name('edit');
            Route::put('/{blogTag}', 'BlogTagController@update')->name('update');
            Route::delete('/{blogTag}', 'BlogTagController@destroy')->name('destroy');
        });

        Route::group(['prefix' => '/comments', 'as' => 'comments.'], function () {
            Route::get('/', 'BlogCommentController@index')->name('index');
            Route::get('/create', 'BlogCommentController@create')->name('create');
            Route::post('/', 'BlogCommentController@store')->name('store');
            Route::get('/{blogComment}', 'BlogCommentController@show')->name('show');
            Route::get('/{blogComment}/edit', 'BlogCommentController@edit')->name('edit');
            Route::put('/{blogComment}', 'BlogCommentController@update')->name('update');
            Route::delete('/{blogComment}', 'BlogCommentController@destroy')->name('destroy');
            Route::get('/approve/{blogComment}', 'BlogCommentController@approve')->name('approve');
            Route::post('/reply/{blogComment}', 'BlogCommentController@reply')->name('reply');
        });
    });
});