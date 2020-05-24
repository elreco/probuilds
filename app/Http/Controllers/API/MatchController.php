<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Match\ShowDetailsRequest;
// ENTITY
use App\Entities\Match\MatchDetailsEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

class MatchController extends Controller
{

    //
    public function showDetails(ShowDetailsRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $matchDetailsEntity = new MatchDetailsEntity($riot);
        return $matchDetailsEntity->getMatchDetails($request);
    }
}
