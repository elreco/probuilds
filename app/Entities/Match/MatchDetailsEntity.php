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

        foreach ($match->teams as $team) {
            if ($team->win == "Win") {
                $i2 = 0;
                foreach ($team->bans as $ban) {
                    $src = DataDragonAPI::getChampionIconO($ban->staticData);
                    $response['winnersBans'][$i2]['title'] =  $ban->staticData->name;
                    $response['winnersBans'][$i2]['src'] =  $src->src;
                    $i2++;
                }
            } else {
                $i2 = 0;
                foreach ($team->bans as $ban) {
                    $src = DataDragonAPI::getChampionIconO($ban->staticData);
                    $response['losersBans'][$i2]['title'] =  $ban->staticData->name;
                    $response['losersBans'][$i2]['src'] =  $src->src;
                    $i2++;
                }
            }
        }
        foreach ($match->participants as $participant) {

            $summonerId = $participantIdentities[$participant->participantId]->summonerId;
            $response['participants'][$i]['summonerId'] = $summonerId;

            $src = DataDragonAPI::getChampionIconO($participant->staticData);
            $response['participants'][$i]['champion'] = [
                'title' => $participant->staticData->name,
                'src' => $src->src,
                'description' => "<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
            ];

            $summonerEntity = new SummonerEntity($this->riot);
            $summoner = $summonerEntity->getSummoner($summonerId);

            $response['participants'][$i]['player'] = [
                'name' => $summoner->name,
                'icon' => DataDragonAPI::getProfileIconO($summoner)->src,
            ];
            $response['participants'][$i] = $matchEntity->addMatchStats($participant, $response['participants'][$i]);
            $i++;
        }
        return $response;
    }

    private function initParticipantsArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'date' => null,
            'winnersBans' => [
                [
                    'title' => null,
                    'src' => null
                ]
            ],
            'losersBans' => [
                [
                    'title' => null,
                    'src' => null
                ]
            ],
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
                    ]
                ],

            ]

        ];
    }
}
