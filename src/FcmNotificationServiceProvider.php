<?php

namespace Benwilkins\FCM;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\ServiceProvider;

/**
 * Class FcmNotificationServiceProvider
 * @package Benwilkins\FCM
 */
class FcmNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/laravel-fcm-notification.php' => config_path('laravel-fcm-notification.php'),
        ]);
    }

    /**
     * Register
     */
    public function register()
    {
        $app = $this->app;
        $this->app->make(ChannelManager::class)->extend('fcm', function() use ($app) {
            return $app->make(FcmChannel::class);
        });
    }
}