<?php

declare(strict_types=1);

use Laravelcm\AbstractIpGeolocation\DataObject\Currency;
use Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData;

it('return response object with appropriates values', function (): void {
    $response = [
        'ip_address' => '166.171.248.255',
        'city' => 'San Jose',
        'currency' => [
            'currency_name' => 'USD',
            'currency_code' => 'USD',
        ],
    ];

    $geolocation = GeolocationData::fromResponse($response);

    expect($geolocation->currency)->toBeInstanceOf(Currency::class)
        ->and($geolocation->ipAddress)->toEqual('166.171.248.255')
        ->and($geolocation)->toHaveProperties([
            'city' => 'San Jose',
            'country' => null,
            'currency' => new Currency(name: 'USD', code: 'USD'),
        ]);
});
