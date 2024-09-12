<?php

namespace Intelrx\Sitesettings;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Intelrx\Sitesettings\Console\Commands\configCommand;

class SitesettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->registerAlias();
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

    public function registerAlias(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('SiteConfig', \Intelrx\Sitesettings\SiteConfig::class);
    }
    
}
