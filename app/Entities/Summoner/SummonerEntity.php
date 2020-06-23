<?php

namespace App\Entities\Summoner;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
use App\Entities\Riot\RiotEntity;

class SummonerEntity
{

    protected $riot;

    public function __construct($riot)
    {
        $this->riot = $riot;
        RiotEntity::initDataDragonAPI();
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
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Summoner not found');
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

    /**
     * Get a summoner by a given summoner id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSummonerDetails($summonerId)
    {
        $response = $this->initSummonerArray();

        $summoner = $this->getSummoner($summonerId);

        $response['name'] = $summoner->name;
        $response['icon'] = DataDragonAPI::getProfileIconO($summoner)->src;
        $response['level'] = $summoner->summonerLevel;
        // summoner rank and points
        $summonerLeague = $this->getLeague($summonerId, "RANKED_SOLO_5x5");

        if (!empty($summonerLeague)) {
            $leagueRank = "";
            if (!in_array($summonerLeague->tier, ["MASTER", "GRANDMASTER", "CHALLENGER"])) {
                $leagueRank = " " . $summonerLeague->rank;
            }
            $response['league'] = $summonerLeague->tier . $leagueRank;
            $response['leagueName'] = ucfirst(strtolower($summonerLeague->tier));
            $response['leaguePoints'] = $summonerLeague->leaguePoints;
        }

        return $response;
    }

    public function initSummonerArray()
    {
        return [
            'name' => null,
            'icon' => null,
            'level' => null,
            'league' => null,
            'leagueName' => null,
            'leaguePoints' => null,
        ];
    }
}
