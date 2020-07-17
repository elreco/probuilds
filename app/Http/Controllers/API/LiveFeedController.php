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


class LiveFeedController extends Controller
{

    /**
     * route : /api/livefeed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LiveFeedRequest $request)
    {
        /* return CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed'); */
        return $this->getLiveFeed($request);
    }

    public function getLiveFeed($request)
    {
        $regions = RegionEntity::getSelectedRegions($request);

        $riotEntity = new RiotEntity($request->locale);
        $riots = $riotEntity->initApiMulti($regions);

        $response = [
            'data' => [],
            'totalItems' => 0,
            'maxItems' => 0,
        ];

        $itemsNumber = 10;
        foreach ($riots as $region => $riot) {

            $request->merge([
                'region' => $region
            ]);
            $matches = CacheEntity::useEntityCache('Match\MatchEntity', 'getMatchesTopElo', $riot, $request);

            /* $matchEntity = new MatchEntity($riot, $request->locale);
            $matches = $matchEntity->getMatchesTopElo($request, $region); */
            $response['data'] = !empty($matches) ? array_merge($response['data'], $matches) : $response['data'];
        }

        $collectionResponse = collect($response['data']);

        if (!empty($request->page)) {
            $response['data'] = $collectionResponse->sortByDesc('date')->forPage($request->page, $itemsNumber)->values();
        }

        // total éléments
        $response['totalItems'] =  $collectionResponse->count();
        // nombre d'items par page
        $response['maxItems'] =  $itemsNumber;

        return $response;
    }
}
