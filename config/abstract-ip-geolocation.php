<?php

declare(strict_types=1);

use Laravelcm\AbstractIpGeolocation\IpSelector;

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    | Your API token from abstractapi.com.
    |
    */

    'api_key' => env('ABSTRACT_IP_GEOLOCATION_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | User IP Address
    |--------------------------------------------------------------------------
    | By default, Abstract IP Geolocation will detect the ip address. But you can
    | update this configuration to include the client's ip address every time.
    |
    | If this value is set to "true", the ip will be detected using the "ip_selector" config.
    |
    */

    'include_ip' => false,

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

    /*
    |--------------------------------------------------------------------------
    | Ip Selector Class
    |--------------------------------------------------------------------------
    | You can select which class will be used to retrieve the client's ip address
    | or you can change it and use your own class to return the ip address.
    |
    | In case you use a custom IP selector, you may implement the
    | \Laravelcm\AbstractIpGeolocation\Contracts\AbstractIpInterface interface
    |
    | Available class: "IpSelector", "OriginatingIpSelector"
    |
    */

    'ip_selector' => new IpSelector(),

    /*
    |--------------------------------------------------------------------------
    | Cache HTTP Request API
    |--------------------------------------------------------------------------
    |
    |
    */

    'cache' => [
        /*
        | By default, requests are cached to retrieve the user's ip.
        | If you use the "Free plan" option, caching can help you save
        | on requests to the Abstract IP Geolocation API.
        */

        'enable' => true,

        /*
        | This value is used to define the number of times a user's ip address can be stored,
        | if it has changed several times in the same session. Once this number has been reached,
        | the old values will be replaced.
        */

        'maxsize' => 5,

        /*
        | Time until cached value is no longer accessible
        | The default cached time is 24 hours (value).
        |
        */

        'ttl' => 86400,
    ],

];
