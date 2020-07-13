<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Spell\ShowRequest;
// ENTITY
use App\Entities\Summoner\SpellEntity;
use App\Entities\Riot\RiotEntity;

class SpellController extends Controller
{

    public function show(ShowRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $spellEntity = new SpellEntity($riot, $request->locale);
        return $spellEntity->getSummonerSpell($request->id);
    }
}
