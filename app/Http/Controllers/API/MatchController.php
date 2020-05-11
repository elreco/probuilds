<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Match\Match;
// ENTITY
use App\Entities\Match\MatchDetailsEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

class MatchController extends Controller
{

    //
    public function showDetails(Match $request)
    {
        $regions = RegionEntity::getSelectedRegions($request);

        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($regions);

        $matchDetailsEntity = new MatchDetailsEntity($riot[$request->region]);
        return $matchDetailsEntity->getMatchDetails();
    }
}
