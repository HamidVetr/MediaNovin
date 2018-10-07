<?php

namespace Mwteam\Blog;

use Mwteam\Blog\App\Models\BlogCategory;
use Mwteam\Blog\App\Models\BlogComment;
use Mwteam\Blog\App\Models\BlogTag;
use Mwteam\Blog\App\Policies\BlogCategoryPolicy;
use Mwteam\Blog\App\Policies\BlogCommentPolicy;
use Mwteam\Blog\App\Policies\BlogTagPolicy;
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
        BlogArticle::class  => BlogArticlePolicy::class,
        BlogTag::class      => BlogTagPolicy::class,
        BlogCategory::class => BlogCategoryPolicy::class,
        BlogComment::class  => BlogCommentPolicy::class,
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
            $notApprovedComments = BlogComment::whereApproved(false)->count();
            $total = $notApprovedComments;
            $view->with([
                'blogNotificationsCount' => [
                    'total' => $total,
                    'blog-comments-index' => $notApprovedComments,
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
