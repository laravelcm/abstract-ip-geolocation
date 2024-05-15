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
}
