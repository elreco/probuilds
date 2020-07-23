<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Spell\ShowRequest;
// ENTITY
use App\Entities\Summoner\SpellEntity;

class SpellController extends Controller
{

    public function show(ShowRequest $request)
    {
        $spellEntity = new SpellEntity($request->locale);
        return $spellEntity->getSummonerSpell($request->id);
    }
}
