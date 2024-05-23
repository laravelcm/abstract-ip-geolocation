<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\DataObject;

final class GeolocationData
{
    public ?string $ipAddress = null;

    public ?string $city = null;

    public ?int $cityGeonameId = null;

    public ?string $region = null;

    public ?string $regionIsoCode = null;

    public ?int $regionGeonameId = null;

    public ?string $postalCode = null;

    public ?string $country = null;

    public ?string $countryCode = null;

    public ?bool $countryIsEU = null;

    public ?string $continent = null;

    public ?string $continentCode = null;

    public ?int $continentGeonameId = null;

    public ?float $longitude = null;

    public ?float $latitude = null;

    public ?Security $security = null;

    public ?Timezone $timezone = null;

    public ?Flag $flag = null;

    public ?Currency $currency = null;

    public ?Connection $connection = null;

    public function __construct(
        ?string $ipAddress = null,
        ?string $city = null,
        ?int $cityGeonameId = null,
        ?string $region = null,
        ?string $regionIsoCode = null,
        ?int $regionGeonameId = null,
        ?string $postalCode = null,
        ?string $country = null,
        ?string $countryCode = null,
        ?bool $countryIsEU = null,
        ?string $continent = null,
        ?string $continentCode = null,
        ?int $continentGeonameId = null,
        ?float $longitude = null,
        ?float $latitude = null,
        ?Security $security = null,
        ?Timezone $timezone = null,
        ?Flag $flag = null,
        ?Currency $currency = null,
        ?Connection $connection = null,
    ) {
        $this->ipAddress = $ipAddress;
        $this->city = $city;
        $this->cityGeonameId = $cityGeonameId;
        $this->regionIsoCode = $regionIsoCode;
        $this->regionGeonameId = $regionGeonameId;
        $this->postalCode = $postalCode;
        $this->region = $region;
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->countryIsEU = $countryIsEU;
        $this->continent = $continent;
        $this->continentCode = $continentCode;
        $this->continentGeonameId = $continentGeonameId;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->security = $security;
        $this->timezone = $timezone;
        $this->flag = $flag;
        $this->currency = $currency;
        $this->connection = $connection;
    }

    public static function fromResponse(array $data): GeolocationData
    {
        return new self(
            ipAddress: self::valueIfExist('ip_address', $data),
            city: self::valueIfExist('city', $data),
            cityGeonameId: self::valueIfExist('city_geoname_id', $data),
            region: self::valueIfExist('region', $data),
            regionIsoCode: self::valueIfExist('region_iso_code', $data),
            regionGeonameId: self::valueIfExist('region_geoname_id', $data),
            postalCode: self::valueIfExist('postal_code', $data),
            country: self::valueIfExist('country', $data),
            countryCode: self::valueIfExist('country_code', $data),
            countryIsEU: self::valueIfExist('country_is_eu', $data),
            continent: self::valueIfExist('continent', $data),
            continentCode: self::valueIfExist('continent_code', $data),
            continentGeonameId: self::valueIfExist('country_geoname_id', $data),
            longitude: self::valueIfExist('longitude', $data),
            latitude: self::valueIfExist('latitude', $data),
            security: array_key_exists('security', $data)
                ? new Security(isVpn: $data['security']['is_vpn'])
                : null,
            timezone: array_key_exists('timezone', $data)
                ? new Timezone(
                    name: $data['timezone']['name'],
                    abbreviation: $data['timezone']['abbreviation'],
                    gmtOffset: $data['timezone']['gmt_offset'],
                    currentTime: $data['timezone']['current_time'],
                    isDST: $data['timezone']['is_dst'],
                )
                : null,
            flag: array_key_exists('flag', $data)
                ? new Flag(
                    svg: $data['flag']['svg'],
                    png: $data['flag']['png'],
                    emoji: $data['flag']['emoji'],
                    unicode: $data['flag']['unicode'],
                )
                : null,
            currency: array_key_exists('currency', $data)
                ? new Currency(
                    name: $data['currency']['currency_name'],
                    code: $data['currency']['currency_code']
                )
                : null,
            connection: array_key_exists('connection', $data)
                ? new Connection(
                    connectionType: $data['connection']['connection_type'],
                    autonomousSystemNumber: $data['connection']['autonomous_system_number'],
                    autonomousSystemOrganization: $data['connection']['autonomous_system_organization'],
                    ispName: $data['connection']['isp_name'],
                    organizationName: $data['connection']['organization_name'],
                )
                : null,
        );
    }

    protected static function valueIfExist(string $key, array $data): mixed
    {
        return array_key_exists($key, $data) ? $data[$key] : null;
    }
}
