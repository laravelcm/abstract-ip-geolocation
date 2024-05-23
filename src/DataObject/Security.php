<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class Security
{
    public function __construct(public bool $isVpn)
    {
    }
}
