<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Match\ShowRequest;
use App\Http\Requests\Match\ItemsTimelineRequest;
// ENTITY
use App\Entities\Match\MatchDetailsEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\CacheEntity;
use App\Entities\ItemEntity;

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

    public function itemsTimeline(ItemsTimelineRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $itemEntity = new ItemEntity($riot, $request->locale);
        return $itemEntity->getTimeline($request);
    }
}
