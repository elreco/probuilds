<?php

namespace App\Entities;

class SummonerEntity
{

    protected $riot;

    public function __construct($riot)
    {
        $this->riot = $riot;
    }

    /**
     * Get a summoner by a given summoner id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSummoner($summonerId)
    {

        try {
            $summoner = $this->riot->getSummoner($summonerId);
        } catch (\Exception $e) {
            return null;
        }

        return $summoner;
    }
}
