<?php

namespace Intelrx\Sitesettings\Console\Commands;

use Illuminate\Console\Command;
use Intelrx\Sitesettings\SiteConfig;
use Intelrx\Sitesettings\SitesettingsProvider;

class configCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:settings';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setups the site settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SiteConfig::update('phone', 'raza');
    }
}
