<?php

namespace App\Entities\Match;

// COLLECTION
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\Summoner\SummonerEntity;
use App\Entities\Match\MatchEntity;
use App\Entities\ChampionEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

use Carbon\CarbonInterval;

class MatchDetailsEntity
{
    //
    use CommonTrait;

    protected $riot;
    protected $locale;

    public function __construct($riot, $locale)
    {
        $this->riot = $riot;
        $this->locale = $locale;
        app()->setLocale($locale);
        RiotEntity::initDataDragonAPI();
    }

    /**
     * Display a collection a top elo matches.
     *
     * @return \Illuminate\Support\Collection
     */

    public function getMatchDetails($request)
    {
        // init match array
        $response = $this->initMatchArray();

        // init entity
        $matchEntity = new MatchEntity($this->riot, $request->locale);
        $regionEntity = new RegionEntity();

        // get match
        $match = $matchEntity->getMatch($request->id);

        if (!empty($match)) {
            // global array data
            $response['matchId'] = $request->id;
            $response['region'] = $request->region;
            $response['date'] = $match->gameCreation ?? null;
            $response['duration'] = CarbonInterval::seconds($match->gameDuration)->cascade()->forHumans();

            // get region name
            $response['regionName'] = $regionEntity->getRegionName($request->region);

            // construction de l'array pour les participants
            $participantIdentities = [];
            foreach ($match->participantIdentities as $participantIdentity) {
                $participantIdentities[$participantIdentity->participantId] = $participantIdentity->player;
            }

            // selected summoner champion data and participant Id
            foreach ($match->participants as $participant) {
                if ($participantIdentities[$participant->participantId]->summonerId == $request->summonerId) {
                    // Verif du champion
                    if ($participant->staticData->name != $request->champion) {
                        throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Wrong champion for this summoner');
                    }
                    // Verif du participantId
                    if ($participant->participantId != $request->participantId) {
                        throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Wrong participant');
                    }
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

        // init entity
        $championEntity = new ChampionEntity($this->locale);
        $summonerEntity = new SummonerEntity($this->riot);

        foreach ($participants as $participant) {
            $response[$i]['participantId'] = $participant->participantId;

            $summonerId = $participantIdentities[$participant->participantId]->summonerId;
            $response[$i]['summonerId'] = $summonerId;

            $response[$i]['champion'] = $championEntity->getChampionDetails($participant->staticData);

            // player
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
            'duration' => null,
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
                'participantId' => null,
                'level' => null,
                'champion' => [],
                'player' => [],
                'win' => null,
                'kda' => null,
                'gold' => null,
                'keystone' => null,
                'subkeystone' => null,
                'items' => [],
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
