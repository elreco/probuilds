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
}
