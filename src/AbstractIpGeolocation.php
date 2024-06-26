<?php

declare(strict_types=1);

namespace Laravelcm\AbstractIpGeolocation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laravelcm\AbstractIpGeolocation\Exceptions\AbstractApiGeolocationException;

class AbstractIpGeolocation
{
    public ?DefaultCache $cache = null;

    public ?string $token = null;

    public ?string $fields = null;

    public function __construct(public Request $request)
    {
        $this->token = config('abstract-ip-geolocation.api_key');
        $this->fields = config('abstract-ip-geolocation.fields');

        if (config('abstract-ip-geolocation.cache.enable')) {
            $this->cache = new DefaultCache();
        }
    }

    /**
     * @throws AbstractApiGeolocationException
     */
    public function initialize(): array
    {
        $ipAddress = null;

        if (config('abstract-ip-geolocation.include_ip')) {
            $ipAddress = (config('abstract-ip-geolocation.ip_selector', new IpSelector()))
                ->getIp($this->request);
        }

        return $this->details($ipAddress);
    }

    /**
     * @throws AbstractApiGeolocationException
     */
    public function details(?string $ipAddress = null): array
    {
        if ($this->cache) {
            $cacheResponse = $this->cache->get($this->cacheKey($ipAddress ?? '-1'));

            if ($cacheResponse !== null) {
                return $cacheResponse;
            }
        }

        try {
            $response = Http::withHeaders([
                'content-type' => 'application/json',
                'accept' => 'application/json',
            ])
                ->get('https://ipgeolocation.abstractapi.com/v1', [
                    'api_key' => $this->token,
                    'fields' => $this->fields,
                    'ip_address' => $ipAddress,
                ]);
        } catch (\Exception $e) {
            throw new AbstractApiGeolocationException($e->getMessage());
        }

        if ($response->status() === 422) {
            throw new AbstractApiGeolocationException('The request was aborted due to insufficient API credits. (Free plan)');
        } elseif ($response->status() >= 400) {
            throw new AbstractApiGeolocationException('Exception: ' . json_encode([
                'status' => $response->status(),
                'message' => $response->body(),
            ]));
        }

        $result = $response->json();

        $this->cache?->set($this->cacheKey($ipAddress ?? '-1'), $result);

        return $result;
    }

    protected function cacheKey(string $key): string
    {
        return sprintf('%s_v%s', $key, '-1');
    }
}
