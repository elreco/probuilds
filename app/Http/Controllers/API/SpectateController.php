<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\LiveFeed\LiveFeedRequest;
// ENTITY
use App\Entities\Match\MatchEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\CacheEntity;


class SpectateController extends Controller
{

    /**
     * route : /api/livefeed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LiveFeedRequest $request)
    {
        /* CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed') */
        return $this->getLiveMatches($request);
    }

    public function getLiveMatches($request)
    {
        $regions = RegionEntity::getSelectedRegions($request);

        $riotEntity = new RiotEntity($request->locale);
        $riots = $riotEntity->initApiMulti($regions);

        $response = [
            'data' => [],
            'totalItems' => 0,
            'maxItems' => 0,
        ];

        return $response;
    }
}
