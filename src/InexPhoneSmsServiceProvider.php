<?php

namespace Caravan\InexPhoneSms;

use Caravan\InexPhoneSms\Http\InexPhoneSmsConnector;
use Illuminate\Support\ServiceProvider;

class InexPhoneSmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/inexphone-sms.php',
            'inexphone-sms'
        );

        $this->app->singleton(InexPhoneSmsConnector::class, function ($app) {
            return new InexPhoneSmsConnector(
                baseUrl: config('inexphone-sms.api_url'),
                token: config('inexphone-sms.api_token'),
                timeout: config('inexphone-sms.timeout'),
                retryAttempts: config('inexphone-sms.retry_attempts'),
                retryDelay: config('inexphone-sms.retry_delay')
            );
        });

        $this->app->singleton(InexPhoneSmsClient::class, function ($app) {
            return new InexPhoneSmsClient($app->make(InexPhoneSmsConnector::class));
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/inexphone-sms.php' => config_path('inexphone-sms.php'),
            ], 'config');
        }
    }
}
