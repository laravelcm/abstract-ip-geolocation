<p align="center">
    <a href="https://laravel.com">
        <img alt="Laravel v10.x" src="https://img.shields.io/badge/Laravel-v10.x-FF2D20">
    </a>
    <a href="https://packagist.org/packages/laravelcm/abstract-ip-geolocation">
        <img src="https://img.shields.io/packagist/dt/laravelcm/abstract-ip-geolocation" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravelcm/abstract-ip-geolocation">
        <img src="https://img.shields.io/packagist/v/laravelcm/abstract-ip-geolocation" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravelcm/abstract-ip-geolocation">
        <img src="https://img.shields.io/packagist/l/laravelcm/abstract-ip-geolocation" alt="License">
    </a>
</p>

# [<img src="https://assets-global.website-files.com/65166126ca18241731aa26b0/65390de624cb65770560dda5_FAV.png" alt="Abstract API" width="24"/>](https://www.abstractapi.com) Abstract’s IP Geolocation API Laravel Client Library

### Getting Started

Abstract’s IP Geolocation API is a fast, lightweight, modern, and RESTful JSON API for determining the location and other details of IP addresses from over 190 countries.

The free plan is limited to 1,000 requests per month. To enable all the data fields and additional request volumes see [https://www.abstractapi.com/api/ip-geolocation-api#pricing](https://www.abstractapi.com/api/ip-geolocation-api#pricing).

### Installation

The package works with PHP 8 and is available using [Composer](https://getcomposer.org).

```shell
composer require laravelcm/abstract-ip-geolocation
``` 

### Usage

Open your application's `\app\Http\Kernel.php` file and add the following to the `Kernel::middleware` property:

```php
protected $middleware = [
    ...
    \Laravelcm\AbstractIpGeolocation\Middleware\AbstractIpGeolocation::class,
];
```

#### Quick Start

```php
Route::get('/', function () {
    $geolocation = session()->get('abstract-ip-geolocation')
    $location = "The IP address " . $geolocation->ipAddress;
    return view('index', ['location' => $location]);
});
```

Will return the following string to the `index` view:

```shell
"The IP address 127.0.0.1"
```

Mais par défaut cet object `$geolocation` est une instance de la classe `\Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData` qui donne toutes les valeurs transformées de l'API (tableau) en objet PHP.
Les informations sont stockées par défaut dans la session depuis le middleware, ce qui vous permet d'avoir accès aux informations n'importe où dans votre code.

Voici le contenu de l'objet `$geolocation` apres un dump:

```bash
Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData {#1164
  +ipAddress: "166.171.248.255"
  +city: "Paris"
  +cityGeonameId: 2997712
  +region: "Île-de-France"
  +regionIsoCode: "IDF"
  +regionGeonameId: 3012874
  +postalCode: "75002"
  +country: "France"
  +countryCode: "FR"
  +countryIsEU: true
  +continent: "Europe"
  +continentCode: "EU"
  +continentGeonameId: 3017382
  +longitude: 2.3024
  +latitude: 48.6939
  +security: Laravelcm\AbstractIpGeolocation\DataObject\Security {#839
    +isVpn: false
  }
  +timezone: Laravelcm\AbstractIpGeolocation\DataObject\Timezone {#1182
    +name: "Europe/Paris"
    +abbreviation: "CEST"
    +gmtOffset: 2
    +currentTime: "19:08:34"
    +isDST: true
  }
  +flag: Laravelcm\AbstractIpGeolocation\DataObject\Flag {#1165
    +svg: "https://static.abstractapi.com/country-flags/FR_flag.svg"
    +png: "https://static.abstractapi.com/country-flags/FR_flag.png"
    +emoji: "🇫🇷"
    +unicode: "U+1F1EB U+1F1F7"
  }
  +currency: Laravelcm\AbstractIpGeolocation\DataObject\Currency {#817
    +name: "Euros"
    +code: "EUR"
  }
  +connection: Laravelcm\AbstractIpGeolocation\DataObject\Connection {#425
    +connectionType: "Cable/DSL"
    +autonomousSystemNumber: 45980
    +autonomousSystemOrganization: "Free SAS"
    +ispName: "ProXad network / Free SAS"
    +organizationName: "Proxad / Free SAS"
  }
}
```

### Configuration
Config file are located at `config/abstract-ip-geolocation.php` after publishing provider element.

#### Fields
By default, all fields are returned by the Abstract API, but you can choose to retrieve just the values you're interested in from the API.
To do this, you need to specify the fields you want (the list of fields is available here https://docs.abstractapi.com/ip-geolocation#request-parameters).

```php
/*
|--------------------------------------------------------------------------
| Geolocation Fields
|--------------------------------------------------------------------------
| You can include a fields value in the query parameters with a comma
| separated list of the top-level keys you want to be returned. For example
| "fields => 'city,region'" will return only the city and region in the response.
|
| see: https://docs.abstractapi.com/ip-geolocation#request-parameters
*/

'fields' => null,
```

Once you've specified the fields you want (e.g. `country,currency`) only these values will be returned by the API and in your geolocations DTO object,
you'll only have the `country` and `currency` values available - the others will be null.

To access this information, consult `session()`.

```php
$geolocation = session()->get('abstract-ip-geolocation');

$geolocation->country // return "France"
$currency = $geolocation->currency // instance of \Laravelcm\AbstractIpGeolocation\DataObject\Currency
```

#### DTO
The available DTO classes are listed below. In the json return from the Abstract Geolocation API, all objects are represented by DTO classes

- `\Laravelcm\AbstractIpGeolocation\DataObject\GeolocationData` which represents the geolocation class containing all information relating to the user via its IP address
- `\Laravelcm\AbstractIpGeolocation\DataObject\Connection` which represents the DTO class for its connection origin information
- `\Laravelcm\AbstractIpGeolocation\DataObject\Currency` which represents the DTO class for the currency
- `\Laravelcm\AbstractIpGeolocation\DataObject\Flag` which represents the DTO class for country flag information
- `\Laravelcm\AbstractIpGeolocation\DataObject\Timezone` which represents the DTO class for Timezone information
- `\Laravelcm\AbstractIpGeolocation\DataObject\Security` which represents the DTO class for security information, lets you know whether the user is using a VPN or not

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
