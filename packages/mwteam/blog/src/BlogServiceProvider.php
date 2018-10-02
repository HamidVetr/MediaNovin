<?php

namespace Mwteam\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Blog');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/blog'),
        ], 'blog/views');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/blog'),
        ], 'blog/lang');

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('/assets'),
        ], 'blog/assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
//                FooCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
