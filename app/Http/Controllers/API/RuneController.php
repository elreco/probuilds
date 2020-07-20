<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Rune\IndexRequest;
// ENTITY
use App\Entities\Summoner\RuneEntity;
use App\Entities\Riot\RiotEntity;

class RuneController extends Controller
{

    public function index(IndexRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $runeEntity = new RuneEntity($riot, $request->locale);
        return $runeEntity->getRunesDetails($request->runes);
    }
}
