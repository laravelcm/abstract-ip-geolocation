<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class Flag
{
    public function __construct(
        public string $svg,
        public string $png,
        public string $emoji,
        public string $unicode,
    ) {
    }
}
