<?php

namespace App\Entities;

use Illuminate\Support\Facades\Cache;

class CacheEntity
{

    const SECONDS = 60 * 60;

    public static function useCache($resource, $request, $method, $force = false)
    {
        $namespace = "App\\Http\\Controllers\\API\\" . $resource;
        $key = CacheEntity::keyGenerator($resource, $method, $request);

        if (Cache::has($key)) {
            if ($force) {
                // force delete cache (from cron job)
                Cache::forget($key);
                $response = app($namespace)->$method($request);
                if (!empty($response)) {
                    Cache::forever($key, $response);
                }
            } else {
                $response = Cache::get($key);
            }
        } else {
            $response = app($namespace)->$method($request);
            Cache::forever($key, $response);
        }
        return $response;
    }

    public static function keyGenerator($resource, $method, $request)
    {
        $key = $resource . "@" .  $method;
        $requestArray = $request->all();
        krsort($requestArray);
        foreach ($requestArray as $r) {
            $key .= "." . strtolower($r);
        }
        return $key;
    }

    public static function useEntityCache($resource, $method, $riot, $locale, $force = false, ...$params)
    {
        $namespace = "\App\\Entities\\" . $resource;

        if ($locale) {
            $entity = new $namespace($riot, $locale);
            $params .= $locale;
        } else {
            $entity = new $namespace($riot);
        }

        $key = CacheEntity::entityKeyGenerator($resource, $method, $params);

        if (Cache::has($key)) {
            if ($force) {
                // force delete cache (from cron job)
                Cache::forget($key);
                $response = $entity->$method(...$params);
                if (!empty($response)) {
                    Cache::forever($key, $response);
                }
            } else {
                $response = Cache::get($key);
            }
        } else {
            $response = $entity->$method(...$params);
            Cache::forever($key, $response);
        }
        return $response;
    }

    public static function entityKeyGenerator($resource, $method, $params)
    {
        $key = $resource . "@" .  $method;
        $requestArray = $params;
        krsort($requestArray);
        foreach ($params as $r) {
            $key .= "." . strtolower($r);
        }
        return $key;
    }
}
