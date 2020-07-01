<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Match\ShowRequest;
use App\Http\Requests\Match\TimelineRequest;
use App\Http\Requests\Match\SpellsRequest;
// ENTITY
use App\Entities\Match\MatchDetailsEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\CacheEntity;
use App\Entities\Match\TimelineEntity;

class MatchController extends Controller
{

    //
    public function show(ShowRequest $request)
    {
        $match = CacheEntity::useCache('MatchController', $request, 'getMatchDetails');
        /* $match = $this->getMatchDetails($request); */
        return $match;
    }

    public function getMatchDetails($request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $matchDetailsEntity = new MatchDetailsEntity($riot, $request->locale);
        return $matchDetailsEntity->getMatchDetails($request);
    }

    public function itemsTimeline(TimelineRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $frames = CacheEntity::useCache('MatchController', $request, 'matchTimeline');

        $timelineEntity = new TimelineEntity($riot, $request->locale);
        return $timelineEntity->getItemsTimeline($frames, $request->participantId);
    }

    public function spells(SpellsRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $frames = CacheEntity::useCache('MatchController', $request, 'matchTimeline');

        $timelineEntity = new TimelineEntity($riot, $request->locale);
        return $timelineEntity->getSpells($frames, $request->participantId, $request->champion);
    }

    public function matchTimeline($request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $timelineEntity = new TimelineEntity($riot, $request->locale);
        return $timelineEntity->getMatchTimeline($request->id);
    }
}
