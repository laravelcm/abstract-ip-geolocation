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

        $this->manageSession($response);

        return $next($request);
    }

    public function manageSession(GeolocationData $geolocation): void
    {
        $sessionKey = 'abstract-ip-geolocation';

        if (session()->exists($sessionKey)) {
            /** @var GeolocationData $currentValue */
            $currentValue = session()->get($sessionKey);

            if ($currentValue->ipAddress !== $geolocation->ipAddress) {
                session()->forget($sessionKey);
                session()->put($sessionKey, $geolocation);
            }
        } else {
            session()->put($sessionKey, $geolocation);
        }
    }
}
