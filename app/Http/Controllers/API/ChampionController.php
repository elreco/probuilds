<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Champion\ChampionRequest;
use App\Http\Requests\Champion\ShowRequest;
use App\Http\Requests\Champion\SpellsRequest;
// ENTITY
use App\Entities\ChampionEntity;

class ChampionController extends Controller
{

    /**
     * route : /api/champions.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(ChampionRequest $request)
    {
        $championEntity = new ChampionEntity($request->locale);
        return $championEntity->getChampionsByName($request);
    }
    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfChampionExists(ChampionRequest $request)
    {
        $championEntity = new ChampionEntity($request->locale);
        return $championEntity->checkIfChampionExists($request);
    }

    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request)
    {
        $championEntity = new ChampionEntity($request->locale);
        return $championEntity->getChampionDetailsByName($request->name);
    }

    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function spells(SpellsRequest $request)
    {
        $championEntity = new ChampionEntity($request->locale);
        return $championEntity->getChampionSpellsById($request->name, $request->id);
    }
}
