<?php

namespace App\Http\Middleware;

use Closure;

use App\Entities\CacheEntity;
use Illuminate\Http\Request;

use Illuminate\Routing\Route;

class Cache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $className = (new \ReflectionClass(get_class($request->route()->getController())))->getShortName();
        $namespace = get_class($request->route()->getController());
        $actionMethod = $request->route()->getActionMethod();
        $key = $className;
        $requestArray = $request->all();
        krsort($requestArray);
        foreach ($requestArray as $r) {
            $key .= "." . $r;
        }
        /* $key = 'livefeed.' . $request->page . "." . $request->locale;
        $key .= !empty($request->champion) ? "." . $request->champion : "";
        $key .= !empty($request->region) ? "." . $request->region : "";
        $key .= !empty($request->lane) ? "." . $request->lane : ""; */

        $livefeed = CacheEntity::useCache($key, $namespace, $actionMethod, [$request]);

        return $livefeed;

        return $next($request);
    }
}
