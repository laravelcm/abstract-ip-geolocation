<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\Middleware;

use Closure;
use Laravelcm\AbstractIpGeolocation\AbstractIpGeolocation as IpGeolocation;
use Laravelcm\AbstractIpGeolocation\DefaultCache;
use Laravelcm\AbstractIpGeolocation\Exceptions\AbstractApiGeolocationException;
use Laravelcm\AbstractIpGeolocation\IpSelector;

final class AbstractIpGeolocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @throws AbstractApiGeolocationException
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $this->getResponse($request);

        $request->merge(['abstract-ip-geolocation' => $response]);

        return $next($request);
    }

    /**
     * Get client's ip response
     *
     * @throws AbstractApiGeolocationException
     */
    public function getResponse($request): array
    {
        $ipAddress = null;
        $cache = null;

        if (config('abstract-ip-geolocation.include_ip')) {
            $ipAddress = (config('abstract-ip-geolocation.ip_selector', new IpSelector()))->getIp($request);
        }

        if (config('abstract-ip-geolocation.cache.enable')) {
            $cache = new DefaultCache();
        }

        $response = new IpGeolocation(
            token: config('abstract-ip-geolocation.api_key'),
            fields: config('abstract-ip-geolocation.fields'),
            cache: $cache
        );

        return $response->details($ipAddress);
    }
}
