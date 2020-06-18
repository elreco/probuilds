<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Match\ShowRequest;
// ENTITY
use App\Entities\Match\MatchDetailsEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\CacheEntity;

class MatchController extends Controller
{

    //
    public function show(ShowRequest $request)
    {
        $match = CacheEntity::useCache('match', $request, 'getMatchDetails');
        return $match;
    }

    public function getMatchDetails($request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $matchDetailsEntity = new MatchDetailsEntity($riot, $request->locale);
        return $matchDetailsEntity->getMatchDetails($request);
    }
}
