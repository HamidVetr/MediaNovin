<?php

namespace Mwteam\BroadcastEmail;

use Mwteam\BroadcastEmail\App\Models\BroadcastEmail;
use Mwteam\Dashboard\PackageServiceProvider as ServiceProvider;
use Mwteam\BroadcastEmail\App\Policies\BroadcastEmailPolicy;

class BroadcastEmailServiceProvider extends ServiceProvider
{
    protected $policies = [
        BroadcastEmail::class => BroadcastEmailPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'broadcast-email');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/broadcast-email'),
        ], 'broadcast-email/views');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/broadcast-email'),
        ], 'broadcast-email/lang');

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('/assets'),
        ], 'broadcast-email/assets');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
