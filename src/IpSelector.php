<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation;

use Laravelcm\AbstractIpGeolocation\Contracts\AbstractIpInterface;

final class IpSelector implements AbstractIpInterface
{
    public function getIpAddress($request): string
    {
        return $request->ip();
    }
}
