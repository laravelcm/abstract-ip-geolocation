<?php

declare(strict_types=1);

use Laravelcm\AbstractIpGeolocation\DefaultCache;

it('default cache has value', function (): void {
    $cache = new DefaultCache();
    $keyOne = 'tool';
    $valueOne = 'laravel';
    $cache->set($keyOne, $valueOne);

    $keyTwo = 'user';
    $valueTwo = 'laravelcm';
    $cache->set($keyTwo, $valueTwo);

    expect($cache->has($keyOne))->toBeTrue()
        ->and($cache->has($keyTwo))->toBeTrue();
});

it('default cache can get value', function (): void {
    $cache = new DefaultCache();
    $keyOne = 'tool';
    $valueOne = 'laravel';
    $cache->set($keyOne, $valueOne);

    $keyTwo = 'user';
    $valueTwo = 'laravelcm';
    $cache->set($keyTwo, $valueTwo);

    expect($cache->get($keyOne))->toEqual($valueOne)
        ->and($cache->get($keyTwo))->toEqual($valueTwo);
});

it('default cache exceed max limit', function (): void {
    $cache = new DefaultCache();
    $keyOne = 'tool';
    $valueOne = 'laravel';
    $cache->set($keyOne, $valueOne);
    expect($cache->get($keyOne))->toEqual($valueOne);

    $keyTwo = 'user';
    $valueTwo = 'laravelcm';
    $cache->set($keyTwo, $valueTwo);
    expect($cache->get($keyTwo))->toEqual($valueTwo);

    // Test that once the maxsize is exceeded, the earliest item is pushed out.
    $keyThree = 'package';
    $valueThree = 'abstract-ip';
    $cache->set($keyThree, $valueThree);
    expect($cache->get($keyThree))->toEqual($valueThree)
        ->and($cache->get($keyTwo))->toEqual($valueTwo)
        ->and($cache->get($keyOne))->toBeNull();
});

it('default cache exceed ttl', function (): void {
    $cache = new DefaultCache();
    $key = 'tool';
    $value = 'laravel';
    $cache->set($key, $value);
    expect($cache->get($key))->toEqual($value);

    sleep(3);
    expect($cache->get($key))->toBeNull();
})->skip();
