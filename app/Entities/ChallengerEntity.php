<?php

namespace App\Entities;

class ChallengerEntity{

    protected $riot = [];

    public function __construct($riot){
        $this->riot = $riot;
    }

    public function getChallengers($numbers){
        // GET CHALLENGERS
        try {
            $challengers = collect($this->riot->getLeagueChallenger("RANKED_SOLO_5x5"))->take($numbers);
        } catch (\Exception $e) {
            return collect();
        }
        return $challengers;
    }

}
