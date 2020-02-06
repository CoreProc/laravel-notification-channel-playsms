<?php

namespace CoreProc\PlaySms;

use Illuminate\Support\ServiceProvider;

class PlaySmsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/playsms.php' => config_path('playsms.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(PlaySmsClient::class, function () {
            return new PlaySmsClient(
                config('playsms.base_url'),
                config('playsms.username'),
                config('playsms.api_key')
            );
        });
    }
}
