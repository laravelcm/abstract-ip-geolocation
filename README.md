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
    $location = "The IP address " . request()->get('abstract-ip-geolocation')['ip_address'];
    return view('index', ['location' => $location]);
});
```

Will return the following string to the `index` view:

```shell
"The IP address 127.0.0.1."
```

### Configuration

wip..
