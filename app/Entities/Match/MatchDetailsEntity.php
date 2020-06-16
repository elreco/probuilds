<?php

namespace App\Entities\Match;

// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\SummonerEntity;
use App\Entities\Match\MatchEntity;
use App\Entities\ChampionEntity;
use App\Entities\RegionEntity;
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
        // init entities
        $matchEntity = new MatchEntity($this->riot);

        // get match
        $match = $matchEntity->getMatch($request->matchId);

        // init match array
        $response = $this->initMatchArray();

        // global array data
        $response['matchId'] = $request->matchId;
        $response['region'] = $request->region;
        $response['date'] = $match->gameCreation ?? null;

        // get region name
        $regionEntity = new RegionEntity();
        $response['regionName'] = $regionEntity->getRegionName($request->region);

        // construction de l'array pour les participants
        $participantIdentities = [];
        foreach ($match->participantIdentities as $participantIdentity) {
            $participantIdentities[$participantIdentity->participantId] = $participantIdentity->player;
        }

        // selected summoner champion data
        foreach ($match->participants as $participant) {
            if ($participantIdentities[$participant->participantId]->summonerId == $request->summonerId) {
                $response['champion'] = $participant->staticData->name;
            }
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
            if ($ban->championId > 0) {
                $src = DataDragonAPI::getChampionIconO($ban->staticData);
                $response[$i]['title'] =  $ban->staticData->name;
                $response[$i]['src'] =  $src->src;
            } else {
                $response[$i]['title'] =  null;
                $response[$i]['src'] =  null;
            }
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

            $championEntity = new ChampionEntity();
            $response[$i]['champion'] = $championEntity->getChampionDetails($participant->staticData);

            // player
            $summonerEntity = new SummonerEntity($this->riot);
            $response[$i]['player'] = $summonerEntity->getSummonerDetails($summonerId);

            $response[$i]['level'] = $participant->stats->champLevel;

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
            'champion' => null,
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
                'level' => null,
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
