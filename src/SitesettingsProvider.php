<?php

namespace Intelrx\Sitesettings;

use Carbon\Carbon;
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
        $this->manageAppConfig();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                configCommand::class,
            ]);
        }
    }

    public function registerAlias(): void
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('SiteConfig', \Intelrx\Sitesettings\SiteConfig::class);
    }

    public function manageAppConfig(): void
    {
        $config[] = [
            'name' =>  Carbon::now()->getTimestampMs() ."_". env('APP_NAME', 'NA'),
            'version' => '1.0.0',
        ];

        $json = json_encode($config, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . '/AppConfig.json', $json);
    }
    
}
