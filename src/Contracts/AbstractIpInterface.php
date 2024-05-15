<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\Contracts;

interface AbstractIpInterface
{
    /**
     * Get IP address of the current visitor.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function getIpAddress($request): string;
}
