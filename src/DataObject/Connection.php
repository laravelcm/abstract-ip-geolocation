<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class Connection
{
    public function __construct(
        public string $connectionType,
        public int $autonomousSystemNumber,
        public string $autonomousSystemOrganization,
        public string $ispName,
        public string $organizationName,
    ) {
    }
}
