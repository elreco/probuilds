<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Champion\ChampionRequest;
use App\Http\Requests\Champion\ShowRequest;
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
    public function checkIfChampionExists(ChampionRequest $request)
    {
        return $this->championEntity->checkIfChampionExists($request);
    }

    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ShowRequest $request)
    {
        return $this->championEntity->getChampionDetailsByName($request);
    }
}
