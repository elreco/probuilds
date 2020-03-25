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

    public function getMatchs(){
        // Get Challengers
        $challengers = $this->getChallengers();
        // Get last matchs for each challenger
        $matchs = $this->getChallengersLastMatch($challengers);
        // Return formated matchs
        return $this->Match->formatMatchs($matchs);
    }

    private function getChallengers(){
        // GET CHALLENGERS
        try {
            $challengers = collect($this->riot->getLeagueChallenger("RANKED_SOLO_5x5"))->slice(1, 20);
        } catch (\Exception $e) {
            return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
        }

        return $challengers;
    }

    private function getChallengersLastMatch($challengers){
        foreach($challengers as $c){
            try {
                $summoner = $this->riot->getSummoner($c->summonerId);
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }

            try {
                $matchs[$c->summonerId] = collect($this->riot->getMatchlistByAccount($summoner->accountId, null, null, null,null,null, 0, 1));
                $matchs[$c->summonerId]['summoner'] = $summoner;
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }
        }

        return collect($matchs);
    }
}
