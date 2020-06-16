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

    /**
     * Get a summoner by a given summoner id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLeague($summonerId, $league)
    {
        $return = null;
        $leagues = [];
        $leagues = $this->riot->getLeagueEntriesForSummoner($summonerId);
        if (!empty($leagues)) {
            foreach ($leagues as $l) {
                if ($l->queueType == $league) {
                    $return = $l;
                }
            }
        }
        return $return;
    }

    public function initSummonerArray()
    {
        return [
            'regionName' => null,
            'summonerName' => null,
            'summonerLeague' => null,
            'summonerLeaguePoints' => null,
        ];
    }
}
