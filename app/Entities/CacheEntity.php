<?php

namespace App\Entities;

use Illuminate\Support\Facades\Cache;

class CacheEntity
{

    const SECONDS = 60 * 60;

    public static function useCache($resource, $request, $method)
    {
        $namespace = "App\\Http\\Controllers\\API\\" . $resource;
        $response = [];
        $key = self::keyGenerator($resource, $method, $request);

        if (Cache::has($key)) {
            if (!empty($request->force)) {
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

        if (!empty($request)) {
            $requestArray = $request->except(['force', 'page']);
            krsort($requestArray);
            foreach ($requestArray as $r) {
                $key .= "." . strtolower($r);
            }
        }
        return $key;
    }

    public static function useEntityCache($resource, $method, $riot, $request, $othersArray = [])
    {
        $namespace = "\App\\Entities\\" . $resource;
        $response = [];
        if ($request->locale) {
            $entity = new $namespace($riot, $request->locale);
        } else {
            $entity = new $namespace($riot);
        }

        $key = self::keyGenerator($resource, $method, $request);

        if (Cache::has($key)) {
            if (!empty($request->force)) {
                // force delete cache (from cron job)
                Cache::forget($key);
                if (empty($othersArray)) {
                    $response = $entity->$method($request);
                } else {
                    $response = $entity->$method($request, $othersArray);
                }
                if (!empty($response)) {
                    Cache::forever($key, $response);
                }
            } else {
                $response = Cache::get($key);
            }
        } else {
            if (empty($othersArray)) {
                $response = $entity->$method($request);
            } else {
                $response = $entity->$method($request, $othersArray);
            }
            Cache::forever($key, $response);
        }
        return $response;
    }
}
