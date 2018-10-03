<?php

namespace Mwteam\Blog;

use Mwteam\Dashboard\PackageServiceProvider as ServiceProvider;
use Mwteam\Blog\App\Models\BlogArticle;
use Mwteam\Blog\App\Policies\BlogArticlePolicy;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        BlogArticle::class => BlogArticlePolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
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

        view()->composer('dashboard::partials.sidebar', function ($view) {
            $view->with([
                'blog_notification_count' => [
                    'total' => 5,
                    'blog-articles-index' => 2,
                    'blog-categories-index' => 3,
                ],
            ]);
        });
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
