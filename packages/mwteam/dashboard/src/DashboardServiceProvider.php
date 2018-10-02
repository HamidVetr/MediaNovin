<?php

namespace Mwteam\Dashboard;

use Illuminate\Support\ServiceProvider;
use Mwteam\Dashboard\Commands\SeedCommand;

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
            __DIR__.'/assets' => public_path('/assets'),
        ], 'dashboard/assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                SeedCommand::class,
            ]);
        }

        view()->composer('dashboard::partials.sidebar', function ($view) {
            $packages = config('packages.packages');
            $menus = [];

            foreach ($packages as $package){
                $config = include base_path('packages/mwteam/'. $package.'/src/config.php');

                if (isset($config['sidebar'])){
                    $menus[] = $config['sidebar'];
                }
            }

            $view->with(['menus' => $menus]);
        });
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
