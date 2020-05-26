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
use App\Entities\Riot\RiotEntity;

class MatchDetailsEntity
{
    //
    use CommonTrait;

    protected $riot;

    public function __construct($riot)
    {
        $this->riot = $riot;
        RiotEntity::initDataDragonAPI();
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

        $response = $this->initParticipantsArray();
        $response['matchId'] = $request->matchId;
        $response['region'] = $request->region;
        $response['summonerId'] = $request->summonerId;

        $response['date'] = $match->gameCreation ?? null;

        // construction de l'array pour les participants
        $participantIdentities = [];
        foreach ($match->participantIdentities as $participantIdentity) {
            $participantIdentities[$participantIdentity->participantId] = $participantIdentity->player;
        }

        $i = 0;

        foreach ($match->participants as $participant) {
            $response['participants'][$i]['summonerId'] = $participantIdentities[$participant->participantId]->summonerId;

            $src = DataDragonAPI::getChampionIconO($participant->staticData);
            $response['participants'][$i]['champion'] = [
                'title' => $participant->staticData->name,
                'src' => $src->src,
                'description' => "<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
            ];
            $response['participants'][$i]['player'] = [
                'title' => $participant->staticData->name,
                'src' => $src->src,
                'description' => "<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
            ];
            $i++;
        }
        dd($response);
        // must returns and array of 10 participants
        // array
        //
        // each participant ==> champion, name, runes, stuff etc...
        /*  $matchOutput = $this->formatMatchesDetails($match); */
        return $response;
    }

    private function initParticipantsArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'date' => null,
            'participants' => [
                [
                    'summonerId' => null,
                    'champion' => [
                        'title' => null,
                        'src' => null,
                        'description' => null
                    ],
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
