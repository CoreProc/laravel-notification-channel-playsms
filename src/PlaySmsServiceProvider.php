<?php

namespace CoreProc\NotificationChannels\PlaySms;

use Illuminate\Support\ServiceProvider;

class PlaySmsServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->bind(PlaySmsClient::class, function () {
            return new PlaySmsClient(
                config('services.playsms.base_url'),
                config('services.playsms.username'),
                config('services.playsms.api_key')
            );
        });
    }
}
