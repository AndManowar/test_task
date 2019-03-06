<?php

namespace APN\YourConnectorNamespace;

use Illuminate\Support\ServiceProvider;

/**
 * Class YourServiceProvider
 * @package APN\YourConnectorNamespace
 */
class YourServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * Inject your connector here.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseConnector::class, function () {
            return new YourConnector(config('your_service.token'), config('your_service.domain'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
