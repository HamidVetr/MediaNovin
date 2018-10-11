<?php

namespace Mwteam\Guide;

use Mwteam\Dashboard\PackageServiceProvider as ServiceProvider;
use Mwteam\Guide\App\Models\Guide;
use Mwteam\Guide\App\Models\GuideCategory;
use Mwteam\Guide\App\Policies\GuideCategoryPolicy;
use Mwteam\Guide\App\Policies\GuidePolicy;

class GuideServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Guide::class         => GuidePolicy::class,
        GuideCategory::class => GuideCategoryPolicy::class,
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Guide');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/guide'),
        ], 'guide/views');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/guide'),
        ], 'guide/lang');

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('/assets'),
        ], 'guide/assets');
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
