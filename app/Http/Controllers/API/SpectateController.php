<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Spectate\SpectateRequest;
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
    public function index(SpectateRequest $request)
    {
        /* return CacheEntity::useCache('SpectateController', $request, 'getLiveMatches'); */
        return $this->getLiveMatches($request);
    }

    public function getLiveMatches($request)
    {
        $regions = RegionEntity::getSelectedRegions($request);

        $riotEntity = new RiotEntity($request->locale);
        $riots = $riotEntity->initApiMulti($regions);

        $response = [
            'matches' => [],
            'queueIDs' => []
        ];

        foreach ($riots as $region => $riot) {
            $request->merge([
                'region' => $region
            ]);

            /* $matchEntity = new MatchEntity($riot, $request->locale);
            $matches = $matchEntity->getLiveMatches($request); */
            $matches = CacheEntity::useEntityCache('Match\MatchEntity', 'getLiveMatches', $riot, $request);
            $response['matches'] = !empty($matches['matches']) ? array_merge($response['matches'], $matches['matches']) : $response['matches'];
            $response['queueIDs'] = !empty($matches['queueIDs']) ? array_merge($response['queueIDs'], $matches['queueIDs']) : $response['queueIDs'];
        }
        return $response;
    }

    public function store()
    {
        event(new \App\Events\Spectate("ok"));
    }
}
