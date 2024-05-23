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

### Configuration
wip..

### Test
wip..

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
