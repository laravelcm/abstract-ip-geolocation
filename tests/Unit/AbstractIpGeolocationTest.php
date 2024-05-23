<?php

declare(strict_types=1);

use Laravelcm\AbstractIpGeolocation\AbstractIpGeolocation;
use Laravelcm\AbstractIpGeolocation\DataObject\Currency;
use Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData;

describe('get default all fields from abstract ip geolocation', function (): void {
    beforeEach(function (): void {
        $this->response = [
            'ip_address' => '166.171.248.255',
            'city' => 'San Jose',
            'city_geoname_id' => 5392171,
            'region' => 'California',
            'region_iso_code' => 'CA',
            'region_geoname_id' => 5332921,
            'postal_code' => '95141',
            'country' => 'United States',
            'country_code' => 'US',
            'country_geoname_id' => 6252001,
            'country_is_eu' => false,
            'continent' => 'North America',
            'continent_code' => 'NA',
            'continent_geoname_id' => 6255149,
            'longitude' => -121.7714,
            'latitude' => 37.1835,
            'security' => [
                'is_vpn' => false,
            ],
            'timezone' => [
                'name' => 'America/Los_Angeles',
                'abbreviation' => 'PDT',
                'gmt_offset' => -7,
                'current_time' => '06:37:41',
                'is_dst' => true,
            ],
            'flag' => [
                'emoji' => '🇺🇸',
                'unicode' => 'U+1F1FA U+1F1F8',
                'png' => 'https://static.abstractapi.com/country-flags/US_flag.png',
                'svg' => 'https://static.abstractapi.com/country-flags/US_flag.svg',
            ],
            'currency' => [
                'currency_name' => 'USD',
                'currency_code' => 'USD',
            ],
            'connection' => [
                'autonomous_system_number' => 20057,
                'autonomous_system_organization' => 'ATT-MOBILITY-LLC-AS20057',
                'connection_type' => 'Cellular',
                'isp_name' => 'AT&T Mobility LLC',
                'organization_name' => 'Service Provider Corporation',
            ],
        ];
    });

    it('will return user geolocation data', function (): void {
        $client = Mockery::mock(AbstractIpGeolocation::class);
        $client->shouldReceive('initialize')
            ->andReturn($this->response);

        $geolocation = $client->initialize();

        expect($geolocation)->toBeArray();
    });

    it('will return data object of the user geolocation', function (): void {
        $client = Mockery::mock(AbstractIpGeolocation::class);
        $client->shouldReceive('initialize')
            ->andReturn($this->response);

        $geolocationObject = GeolocationData::fromResponse($client->initialize());

        expect($geolocationObject)->toBeInstanceOf(GeolocationData::class)
            ->and($geolocationObject->currency)->toHaveProperties([
                'name' => 'USD',
                'code' => 'USD',
            ])
            ->and($geolocationObject->ipAddress)->toEqual('166.171.248.255');
    });
});

it('will return only the fields specified', function (): void {
    $response = [
        'country' => 'United States',
        'currency' => [
            'currency_name' => 'USD',
            'currency_code' => 'USD',
        ],
    ];

    $client = Mockery::mock(AbstractIpGeolocation::class);
    $client->shouldReceive('initialize')
        ->andReturn($response);

    $geolocation = GeolocationData::fromResponse($client->initialize());

    expect($geolocation->country)->toEqual('United States')
        ->and($geolocation->currency)->toBeInstanceOf(Currency::class);
});
