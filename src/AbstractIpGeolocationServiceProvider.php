<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class AbstractIpGeolocationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('abstract-ip-geolocation')
            ->hasConfigFile();
    }
}
