<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation;

use Laravelcm\AbstractIpGeolocation\Contracts\AbstractIpInterface;

final class OriginatingIpSelector implements AbstractIpInterface
{
    public function getIpAddress($request): string
    {
        $xForwardedFor = $request->headers->get('x-forwarded-for');

        if (empty($xForwardedFor)) {
            $ip = $request->ip();
        } else {
            $ips = explode(',', $xForwardedFor);
            // trim as officially the space comes after each comma separator
            $ip = trim($ips[0]);
        }

        return $ip;
    }
}
