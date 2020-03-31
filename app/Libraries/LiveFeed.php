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
    private $Match;

    protected $riot;

    public function __construct($riot){
        $this->riot = $riot;
        $this->Match = new Match($riot);
    }

    public function getMatchs(?Int $pageNumber = 1, Int $itemsNumber, ?String $lane, ?String $region){
        // Get Challengers
        $challengers = $this->getChallengers(5);
        // Get last matchs for each challenger
        $matchs = $this->Match->getChallengersLastMatch($challengers);
        // Return formated matchs
        return $this->Match->formatMatchs($matchs, $pageNumber, $itemsNumber, $lane, $region);
    }

    public function getChallengers(Int $numbers){
        // GET CHALLENGERS
        try {
            $challengers = collect($this->riot->getLeagueChallenger("RANKED_SOLO_5x5"))->slice(1, $numbers);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $challengers;
    }
}
