<?php

namespace App\Entities\Match;

// COLLECTION
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\Match\MatchEntity;
use App\Entities\ChampionEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\Summoner\RuneEntity;
use App\Entities\CacheEntity;
use Illuminate\Http\Request;

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
        /* $match = $matchEntity->getMatch($request->id); */
        $requestMatch = new Request();
        $requestMatch->replace([
            'locale' => $request->locale,
            'id' => $request->id,
            'force' => false,
        ]);
        $match = CacheEntity::useEntityCache('Match\MatchEntity', 'getMatch', $this->riot, $requestMatch);
        if (!empty($match)) {
            // global array data
            $response['matchId'] = $request->id;
            $response['region'] = $request->region;
            $response['date'] = $match->gameCreation ?? null;
            $response['duration'] = CarbonInterval::seconds($match->gameDuration)->cascade()->forHumans();

            // get region name
            $response['regionName'] = $regionEntity->getRegionName($request->region);

            // construction de l'array pour les participants
            $participantIdentities = $this->getParticipantIdentities($match);
            $participantInfos = $this->getParticipantInfos($request, $match, $participantIdentities);
            // champion
            $response['champion'] = $participantInfos['champion'];
            // runes
            $response['runes'] = $participantInfos['runes'];
            // build winners and losers
            foreach ($match->teams as $team) {
                if ($team->win == "Win") {
                    $response['winners']['bans'] = $this->bans($team);

                    // winners participants
                    $winners = array_filter($match->participants, function ($var) use ($team) {
                        return ($var->teamId == $team->teamId);
                    });

                    $response['winners']['participants'] = $this->participants($winners, $participantIdentities, $matchEntity, $request);
                } else {

                    $response['losers']['bans'] = $this->bans($team);

                    // losers participants
                    $losers = array_filter($match->participants, function ($var) use ($team) {
                        return ($var->teamId == $team->teamId);
                    });


                    $response['losers']['participants'] = $this->participants($losers, $participantIdentities, $matchEntity, $request);
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

    public function participants($participants, $participantIdentities, $matchEntity, $request)
    {
        $i = 0;
        $response = [];

        // init entity
        $championEntity = new ChampionEntity($this->locale);

        foreach ($participants as $participant) {
            $response[$i]['participantId'] = $participant->participantId;

            $summonerId = $participantIdentities[$participant->participantId]->summonerId;
            $response[$i]['summonerId'] = $summonerId;

            $response[$i]['champion'] = $championEntity->getChampionDetails($participant->staticData);

            // player
            /* $summonerEntity->getSummonerDetails($requestSummoner) */
            $requestSummoner = new Request();
            $requestSummoner->replace([
                'id' => $summonerId,
                'force' => !empty($request->force) ? env("APP_KEY") : false,
            ]);
            $response[$i]['player'] = CacheEntity::useEntityCache('Summoner\SummonerEntity', 'getSummonerDetails', $this->riot, $requestSummoner);

            $response[$i]['level'] = $participant->stats->champLevel;

            $response[$i] = $matchEntity->addMatchStats($participant, $response[$i]);
            $i++;
        }
        return $response;
    }

    public function getParticipantInfos($request, $match, $participantIdentities)
    {
        $response = [];
        $runeEntity = new RuneEntity($this->riot, $this->locale);
        $championEntity = new ChampionEntity($this->locale);

        // selected summoner champion data and participant Id
        foreach ($match->participants as $participant) {
            if ($participantIdentities[$participant->participantId]->summonerId == $request->summonerId) {
                // Verif du champion
                $championDetails = $championEntity->getChampionDetails($participant->staticData);

                if (!empty($request->champion) && (!empty($championDetails['id']) && $championDetails['id'] != $request->champion)) {
                    throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Wrong champion for this summoner');
                }
                // Verif du participantId
                if (!empty($request->participantId) && $participant->participantId != $request->participantId) {
                    throw new \Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException('Wrong participant');
                }

                $response['runes'] = $runeEntity->getRunesIDs($participant);
                $response['champion'] = $participant->staticData->name;
                $response['participantId'] = $participant->participantId;
            }
        }
        return $response;
    }

    public function getParticipantIdentities($match)
    {
        // construction de l'array pour les participants
        $participantIdentities = [];
        foreach ($match->participantIdentities as $participantIdentity) {
            $participantIdentities[$participantIdentity->participantId] = $participantIdentity->player;
        }
        return $participantIdentities;
    }

    private function initMatchArray()
    {
        return [
            'matchId' => null,
            'duration' => null,
            'region' => null,
            'champion' => null,
            'date' => null,
            'runes' => null,
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
                'summonerSpells' => []
            ];
        }
        return $array;
    }
}
