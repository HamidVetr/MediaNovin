<?php

namespace Mwteam\Dashboard;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'dashboard');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config.php' => config_path('packages.php'),
        ], 'dashboard/config');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/dashboard'),
        ], 'dashboard/views');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/dashboard'),
        ], 'dashboard/lang');

        $this->publishes([
            __DIR__.'/assets' => public_path('/'),
        ], 'dashboard/assets');
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
