<?php

namespace Caravan\InexPhoneSms\Tests;

use Caravan\InexPhoneSms\InexPhoneSmsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            InexPhoneSmsServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('inexphone-sms.api_token', 'test-token');
        config()->set('inexphone-sms.api_url', 'https://test-api.inexphone.ge/api/v1');
    }
}
