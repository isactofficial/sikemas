<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Web\WebDriver;

class BotManServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('botman', function ($app) {
            // Load the Web Driver
            DriverManager::loadDriver(WebDriver::class);

            // Create BotMan instance with configuration
            $config = config('botman', []);
            
            return BotManFactory::create($config);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
