<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation;

use Illuminate\Support\Facades\Cache;
use Laravelcm\AbstractIpGeolocation\Contracts\CacheInterface;

final class DefaultCache implements CacheInterface
{
    public int $maxsize;

    public int $ttl;

    private array $elements = [];

    public function __construct()
    {
        $this->maxsize = (int) config('abstract-ip-geolocation.cache.maxsize');
        $this->ttl = (int) config('abstract-ip-geolocation.cache.ttl');
    }

    public function has(string $name): bool
    {
        return Cache::has($name);
    }

    public function get(string $name): mixed
    {
        return Cache::get($name);
    }

    public function set(string $name, $value): void
    {
        if (! $this->has($name)) {
            $this->elements[] = $name;
        }

        Cache::put($name, $value, $this->ttl);

        $this->manageSize();
    }

    /**
     * If cache maxsize has been reached, remove oldest elements until limit is reached.
     */
    private function manageSize(): void
    {
        $overflow = count($this->elements) - $this->maxsize;

        if ($overflow > 0) {
            foreach (array_slice($this->elements, 0, $overflow) as $name) {
                if ($this->has($name)) {
                    Cache::forget($name);
                }
            }
            $this->elements = array_slice($this->elements, $overflow);
        }
    }
}
