<?php

namespace App\Libraries;
// LIBRARIES
use App\Libraries\Riot;
use App\Libraries\Match;
// EXCEPTION
use HttpException;
// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;

class LiveFeed
{

    protected $riots = [];

    public function __construct($regions){
        foreach($regions as $r){
            $this->riots[] = Riot::initApi($r);
        }
    }

    public function getMatchs(?String $lane, ?Int $pageNumber, ?Int $itemsNumber, ?String $champion){

        $data = [];
        $response = [
            'data' => [],
            'totalItems' => 0,
            'maxItems' => 0,
        ];

        foreach($this->riots as $r){
            $Match = new Match($r);
            // Get Challengers
            $challengers = $this->getChallengers(1, $r);
            // Get last matchs for each challenger
            $matchs = $Match->getChallengersLastMatch($challengers, $champion);
            // get formatted matchs
            $formattedMatchs = $Match->formatMatchs($matchs, $lane);


            foreach($formattedMatchs as $fm){
                $data[] = $fm;
            }
        }

        // COLLECTION
        $data = collect($data)->sortByDesc('date');
        $response['data'] = $data->forPage($pageNumber, $itemsNumber)->values();
        // total éléments
        $response['totalItems'] =  $data->count();
        // nombre d'items par page
        $response['maxItems'] =  $itemsNumber;
        // Return formated matchs
        return $response;
    }

    public function getChallengers(Int $numbers, $riot){
        // GET CHALLENGERS
        try {
            $challengers = collect($riot->getLeagueChallenger("RANKED_SOLO_5x5"))->slice(1, $numbers);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return $challengers;
    }
}
