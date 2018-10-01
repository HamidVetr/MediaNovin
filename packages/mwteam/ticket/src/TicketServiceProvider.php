<?php

namespace Mwteam\Ticket;

use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'ticket');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/ticket'),
        ], 'ticket/views');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/ticket'),
        ], 'ticket/lang');

        $this->publishes([
            __DIR__.'/assets' => public_path('/'),
        ], 'ticket/assets');
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
