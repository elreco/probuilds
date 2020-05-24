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
use App\Entities\Match\MatchEntity;

class MatchDetailsEntity
{
    //
    use CommonTrait;

    protected $riot;

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
        $matchEntity = new MatchEntity($this->riot);
        $match = $matchEntity->getMatch($request->matchId);
        dd($match);
        // must returns and array of 10 participants
        // array
        //
        // each participant ==> champion, name, runes, stuff etc...
        /*  $matchOutput = $this->formatMatchesDetails($match); */
        return $match;
    }

    private function initParticipantsArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'participants' => [
                [
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
                ]
            ]

        ];
    }
}
