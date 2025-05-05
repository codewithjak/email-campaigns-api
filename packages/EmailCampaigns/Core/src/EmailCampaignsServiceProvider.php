<?php

namespace EmailCampaigns\Core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class EmailCampaignsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Log::info('EmailCampaignsServiceProvider booting...');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'emailcampaigns');
    }
}
