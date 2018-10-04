<?php

namespace Mwteam\Dashboard;

use App\Models\User;
use Mwteam\Dashboard\App\Policies\AdminPolicy;
use Mwteam\Dashboard\PackageServiceProvider as ServiceProvider;
use Mwteam\Dashboard\App\Console\Commands\SeedCommand;

class DashboardServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => AdminPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'dashboard');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/config.php' => config_path('packages.php'),
        ], 'dashboard/config');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/dashboard'),
        ], 'dashboard/views');

        $this->publishes([
            __DIR__.'/resources/lang' => resource_path('lang/vendor/dashboard'),
        ], 'dashboard/lang');

        $this->publishes([
            __DIR__.'/resources/assets' => public_path('/assets'),
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
                    $menus[$package] = $config['sidebar'];
                }
            }

            $view->with(['menus' => $menus]);
        });

        view()->composer('dashboard::partials.sidebar', function ($view) {
            $packages = config('packages.packages');
            $menus = [];

            foreach ($packages as $package){
                $config = include base_path('packages/mwteam/'. $package.'/src/config.php');

                if (isset($config['sidebar'])){
                    $menus[$package] = $config['sidebar'];
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
