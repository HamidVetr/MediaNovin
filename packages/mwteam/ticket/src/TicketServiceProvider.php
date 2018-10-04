<?php

namespace Mwteam\Ticket;

use Mwteam\Dashboard\PackageServiceProvider as ServiceProvider;
use Mwteam\Ticket\App\Models\Ticket;
use Mwteam\Ticket\App\Policies\TicketPolicy;

class TicketServiceProvider extends ServiceProvider
{
    protected $policies = [
        Ticket::class => TicketPolicy::class,
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'ticket');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/ticket'),
        ], 'ticket/views');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/ticket'),
        ], 'ticket/lang');

        $this->publishes([
            __DIR__ . '/resources/assets' => public_path('/assets'),
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
