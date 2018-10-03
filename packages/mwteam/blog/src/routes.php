<?php

Route::group(['middleware' => ['web']], function () {
    Route::group(['prefix' => '/dashboard/blog', 'as' => 'dashboard.blog.', 'namespace' => '\Mwteam\Blog\App\Http\Controllers'], function () {
        Route::group(['prefix' => '/articles', 'as' => 'articles.'], function () {
            Route::resource('/', 'BlogArticleController');
        });

        Route::group(['prefix' => '/categories', 'as' => 'categories.'], function () {
            Route::resource('/', 'BlogCategoryController');
        });

        Route::group(['prefix' => '/tags', 'as' => 'tags.'], function () {
            Route::resource('/', 'BlogTagController');
        });

        Route::group(['prefix' => '/comments', 'as' => 'comments.'], function () {
            Route::resource('/', 'BlogCommentController');
        });
    });
});