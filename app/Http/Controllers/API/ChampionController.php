<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// REQUEST
use App\Http\Requests\Champion;
// ENTITY
use App\Entities\ChampionEntity;

class ChampionController extends Controller
{
    protected $championEntity;


    public function __construct(){
        $this->championEntity = new ChampionEntity;
    }

    /**
     * route : /api/champions.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Champion $request)
    {
        return $this->championEntity->getChampionsByName($request);
    }
    /**
     * route : /api/champions/check.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkIfChampionExists(String $championName)
    {
        return $this->championEntity->checkIfChampionExists($championName);
    }
}
