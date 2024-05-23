<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation\Contracts;

interface CacheInterface
{
    public function has(string $name): bool;

    public function get(string $name): mixed;

    public function set(string $name, $value): void;
}
