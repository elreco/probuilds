<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Summoner\ShowRequest;
// ENTITY
use App\Entities\Summoner\SummonerEntity;
use App\Entities\Riot\RiotEntity;

class SummonerController extends Controller
{

    //
    public function show(ShowRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $summonerEntity = new SummonerEntity($riot);
        return $summonerEntity->getSummonerDetails($request);
    }
}
