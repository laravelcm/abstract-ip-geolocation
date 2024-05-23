<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\Tests;

use Laravelcm\AbstractIpGeolocation\AbstractIpGeolocationServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            AbstractIpGeolocationServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('abstract-ip-geolocation.api_key', '4d489ae38ce97ab4c0');
        $app['config']->set('abstract-ip-geolocation.cache.maxsize', '2');
        $app['config']->set('abstract-ip-geolocation.cache.ttl', '2');
    }
}
