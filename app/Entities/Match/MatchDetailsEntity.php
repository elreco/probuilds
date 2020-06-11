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
        $response = $this->initMatchArray();
        $response['matchId'] = $request->matchId;
        $response['region'] = $request->region;
        $response['summonerId'] = $request->summonerId;

        $response['date'] = $match->gameCreation ?? null;

        // construction de l'array pour les participants
        $participantIdentities = [];
        foreach ($match->participantIdentities as $participantIdentity) {
            $participantIdentities[$participantIdentity->participantId] = $participantIdentity->player;
        }

        // build winners and losers
        foreach ($match->teams as $team) {
            if ($team->win == "Win") {

                $response['winners']['bans'] = $this->bans($team);

                // winners participants
                $winners = array_filter($match->participants, function ($var) use ($team) {
                    return ($var->teamId == $team->teamId);
                });

                $response['winners']['participants'] = $this->participants($winners, $participantIdentities, $matchEntity);
            } else {

                $response['losers']['bans'] = $this->bans($team);

                // losers participants
                $losers = array_filter($match->participants, function ($var) use ($team) {
                    return ($var->teamId == $team->teamId);
                });

                $response['losers']['participants'] = $this->participants($losers, $participantIdentities, $matchEntity);
            }
        }

        return $response;
    }

    public function bans($team)
    {
        $i = 0;
        $response = [];
        foreach ($team->bans as $ban) {
            $src = DataDragonAPI::getChampionIconO($ban->staticData);
            $response[$i]['title'] =  $ban->staticData->name;
            $response[$i]['src'] =  $src->src;
            $i++;
        }
        return $response;
    }

    public function participants($participants, $participantIdentities, $matchEntity)
    {
        $i = 0;
        $response = [];
        foreach ($participants as $participant) {

            $summonerId = $participantIdentities[$participant->participantId]->summonerId;
            $response[$i]['summonerId'] = $summonerId;

            $src = DataDragonAPI::getChampionIconO($participant->staticData);
            $response[$i]['champion'] = [
                'title' => $participant->staticData->name,
                'src' => $src->src,
                'description' => "<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
            ];

            $summonerEntity = new SummonerEntity($this->riot);
            $summoner = $summonerEntity->getSummoner($summonerId);

            $response[$i]['player'] = [
                'name' => $summoner->name,
                'icon' => DataDragonAPI::getProfileIconO($summoner)->src,
            ];
            $response[$i] = $matchEntity->addMatchStats($participant, $response[$i]);
            $i++;
        }
        return $response;
    }

    private function initMatchArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'date' => null,
            'winners' =>
            [
                'bans' => [],
                'participants' => $this->initParticipantsArray(5)
            ],
            'losers' => [
                'bans' => [],
                'participants' => $this->initParticipantsArray(5)
            ]
        ];
    }

    private function initParticipantsArray($numbers)
    {
        for ($i = 0; $i < $numbers; $i++) {
            $array[$i] = [
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
            ];
        }
        return $array;
    }
}
