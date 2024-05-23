<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class Currency
{
    public function __construct(
        public string $name,
        public string $code,
    ) {
    }
}
