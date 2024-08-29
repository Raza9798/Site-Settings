<?php

namespace Intelrx\Sitesettings;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Intelrx\Sitesettings\Console\Commands\configCommand;

class SitesettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }
    }

    
}
