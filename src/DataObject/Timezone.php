<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class Timezone
{
    public function __construct(
        public string $name,
        public string $abbreviation,
        public int $gmtOffset,
        public string $currentTime,
        public bool $isDST,
    ) {
    }
}
