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
        return $this->getLiveMatches($request);
    }

    public function getLiveMatches($request)
    {

        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi("EUW");

        dd($riot->getFeaturedGames());
    }
}
