<?php

namespace App\Entities\Match;

// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\SummonerEntity;
use App\Entities\ChampionEntity;
use App\Entities\ChallengerEntity;

class MatchDetailsEntity
{
    //
    use CommonTrait;

    protected $riot = [];

    public function __construct($riot)
    {
        $this->riot = $riot;
    }

    /**
     * Display a collection a top elo matches.
     *
     * @return \Illuminate\Support\Collection
     */

    public function getMatchDetails($request)
    {
        return [];
    }

    private function initMatchArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'champion' => [
                'title' => null,
                'src' => null,
                'description' => null
            ],
            'date' => null,
            'player' => [
                'name' => null,
                'icon' => null
            ],
            'win' => null,
            'kda' => null,
            'gold' => null,
            'keystone' => null,
            'subkeystone' => null,
            'slots' => [],
            'spells' => [
                1 => [
                    'src' => null,
                    'title' => null,
                    'description' => null
                ],
                2 => [
                    'src' => null,
                    'title' => null,
                    'description' => null
                ],
            ],
            'vs' => [
                'title' => null,
                'src' => null,
                'description' => null
            ]
        ];
    }
}
