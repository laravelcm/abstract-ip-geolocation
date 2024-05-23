<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\Middleware;

use Closure;
use Laravelcm\AbstractIpGeolocation\AbstractIpGeolocation as IpGeolocation;
use Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData;
use Laravelcm\AbstractIpGeolocation\Exceptions\AbstractApiGeolocationException;

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
        $response = GeolocationData::fromResponse(
            (new IpGeolocation($request))->initialize()
        );

        session()->put('abstract-ip-geolocation', $response);

        return $next($request);
    }
}
