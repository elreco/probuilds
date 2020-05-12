<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Champion\ChampionRequest;
// ENTITY
use App\Entities\ChampionEntity;

class ChampionController extends Controller
{
    protected $championEntity;


    public function __construct()
    {
        $this->championEntity = new ChampionEntity;
    }

    /**
     * route : /api/champions.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(ChampionRequest $request)
    {
        return $this->championEntity->getChampionsByName($request);
    }
    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfChampionExists(Champion $request)
    {
        return $this->championEntity->checkIfChampionExists($request);
    }
}
