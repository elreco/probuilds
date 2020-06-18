<?php

namespace App\Entities;

use Illuminate\Support\Facades\Cache;

class CacheEntity
{

    const SECONDS = 600;

    public static function useCache($resource, $request, $method)
    {
        $namespace = get_class($request->route()->getController());
        $key = CacheEntity::keyGenerator($resource, $request);

        if (Cache::has($key)) {
            $response = Cache::get($key);
        } else {
            $response = app($namespace)->$method($request);
            Cache::add($key, $response, self::SECONDS);
        }
        return $response;
    }

    public static function keyGenerator($resource, $request)
    {
        $key = $resource;
        $requestArray = $request->all();
        krsort($requestArray);
        foreach ($requestArray as $r) {
            $key .= "." . $r;
        }
        return $key;
    }
}
