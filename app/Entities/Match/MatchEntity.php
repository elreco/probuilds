<?php

namespace App\Entities\Match;

// COLLECTION
use App\Http\Traits\CommonTrait;
// ENTITY
use App\Entities\Summoner\SummonerEntity;
use App\Entities\ChampionEntity;
use App\Entities\Summoner\ChallengerEntity;
use App\Entities\ItemEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\Summoner\SpellEntity;
use App\Entities\Summoner\RuneEntity;
use App\Entities\CacheEntity;

use Illuminate\Http\Request;

class MatchEntity
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

    public function getMatchesTopElo($request, $region)
    {

        // Get Challengers
        /* $challengerEntity = new ChallengerEntity($this->riot);
        $challengers = $challengerEntity->getChallengers(20); */
        $challengersNumber = 1;

        $challengers = CacheEntity::useEntityCache('Summoner\ChallengerEntity', 'getChallengers', $this->riot, null, false, $region, $challengersNumber);
        // Get last matchs for each challenger
        $challengersLastMatch = $this->getChallengersLastMatch($challengers, $request);
        // return an array of matches
        $matches = $this->formatMatches($challengersLastMatch, $request, $region);
        return $matches;
    }

    /**
     * Format the matches from riot api return.
     *
     * @return Array
     */
    public function formatMatches($matches, $request, $region)
    {
        $i = 0;
        $lane = $request->lane;
        $response = [];
        // entities
        $championEntity = new ChampionEntity($this->locale);
        $summonerEntity = new SummonerEntity($this->riot);
        // equivalent de if !empty
        foreach ($matches as $summonerId => $m) {
            $matchApi = $this->getMatch($m[0]->gameId);
            if (!empty($matchApi)) {
                // position REF
                $positionRef = $this->getRiotPosition($m[0]->lane, $m[0]->role);
                // LANE FILTER
                if (!empty($lane)) {
                    if ($lane == "support") {
                        if ($positionRef  != "UTILITY") {
                            continue;
                        }
                    } elseif ($lane == "adc") {
                        if ($positionRef != "BOTTOM") {
                            continue;
                        }
                    } elseif ($lane == "mid") {
                        if ($positionRef != "MIDDLE") {
                            continue;
                        }
                    } elseif ($lane == "top") {
                        if ($positionRef != "TOP") {
                            continue;
                        }
                    } elseif ($lane == "jungle") {
                        if ($positionRef != "JUNGLE") {
                            continue;
                        }
                    }
                }
                // init array
                $response[$i] = $this->initMatchArray();
                // GAME ID
                $response[$i]['matchId'] = $m[0]->gameId;
                // region
                $response[$i]['region'] = $region;
                // summonerId
                $response[$i]['summonerId'] = $summonerId;
                // champion
                $response[$i]['champion'] = $championEntity->getChampionDetails($m[0]->staticData);

                // DATE
                $response[$i]['date'] = $m[0]->timestamp;

                // PLAYER
                $response[$i]['player'] = $summonerEntity->getSummonerDetails($m['summoner']->id);
                ////////////////////////
                /// SEARCH VS PLAYER ///
                ////////////////////////
                // MATCH FROM API


                //Identité des joueurs
                $participantIdentities = [];
                $participantIdentitiesAPI = $matchApi->participantIdentities;

                foreach ($participantIdentitiesAPI as $participantIdentity) {
                    $participantIdentities[$participantIdentity->participantId] = $participantIdentity;
                    if ($summonerId == $participantIdentity->player->summonerId) {
                        $playerParticipantId = $participantIdentity->participantId;
                    }
                }

                // Joueurs
                $participantsAPI = $matchApi->participants;

                foreach ($participantsAPI as $participant) {
                    // GET PLAYER
                    if ($participant->participantId == $playerParticipantId) {
                        $playerParticipant = $participant;
                        $response[$i]['participantId'] = $participant->participantId;
                        $response[$i] = $this->addMatchStats($participant, $response[$i]);
                    }
                }
                //https://riot-api-libraries.readthedocs.io/en/latest/roleid.html#a-simple-mapping

                foreach ($participantsAPI as $participant) {
                    // GET VS CHAMPION
                    $participantPosition = $this->getRiotPosition($participant->timeline->lane, $participant->timeline->role);
                    if (
                        $playerParticipantId != $participant->participantId
                        &&  $playerParticipant->teamId != $participant->teamId
                        && $positionRef == $participantPosition
                    ) {
                        $response[$i]['vs'] = $championEntity->getChampionDetails($participant->staticData);
                    }
                }

                // cache the entire match
                foreach ($participantsAPI as $participant) {
                    $customRequest = new Request();
                    $customRequests = [
                        'id' => $m[0]->gameId,
                        'locale' => $this->locale,
                        'region' => $region,
                        'summonerId' => $participantIdentities[$participant->participantId]->player->summonerId,
                        'champion' => $participant->staticData->name,
                        'participantId' => $participant->participantId
                    ];
                    $customRequest->replace($customRequests);
                    CacheEntity::useCache('MatchController', $customRequest, 'getMatchDetails');
                }
            }
            $i++;
        }

        // Return formated matchs
        return $response;
    }

    public function getRiotPosition($laneFilter, $roleFilter)
    {
        $position = null;
        if ($laneFilter == 'MID' && $roleFilter == 'SOLO') {
            $position = "MIDDLE";
        }
        if ($laneFilter == 'TOP' && $roleFilter == 'SOLO') {
            $position = "TOP";
        }
        if ($laneFilter == 'JUNGLE' && $roleFilter == 'NONE') {
            $position = "JUNGLE";
        }
        if ($laneFilter == 'BOTTOM' && $roleFilter == 'DUO_CARRY') {
            $position = "BOTTOM";
        }
        if ($laneFilter == 'BOTTOM' && $roleFilter == 'DUO_SUPPORT') {
            $position = "UTILITY";
        }
        return $position;
    }

    /**
     * Display a collection of last match for each challengers.
     *
     * @return \Illuminate\Support\Collection
     */

    public function getChallengersLastMatch($challengers, $request)
    {
        $matches = [];
        if (!empty($challengers)) {
            // init entity
            $summonerEntity = new SummonerEntity($this->riot);
            $championEntity = new ChampionEntity($this->locale);
            foreach ($challengers as $c) {

                $summoner = $summonerEntity->getSummoner($c->summonerId);
                if (empty($summoner)) continue;

                // get account Id
                $accountId = $summoner->accountId;

                // GET CHAMPION KEY
                $championKey = $championEntity->getChampionKey($request->champion);

                // get last match
                $lastMatch = $this->getLastMatch($accountId, $championKey);

                if (!empty($lastMatch)) {
                    $matches[$c->summonerId] = $lastMatch;
                    $matches[$c->summonerId]['summoner'] = $summoner;
                }
            }
        }
        // to collection
        return collect($matches);
    }

    /**
     * Display last match for a given account Id, champion key is not required.
     *
     * @return \Illuminate\Support\Collection
     */

    public function getLastMatch($accountId, $championKey = null)
    {
        try {
            $match = collect($this->riot->getMatchlistByAccount($accountId, 420, null, $championKey, null, null, 0, 1));
        } catch (\Exception $e) {
            return null;
        }
        return $match;
    }

    public function getMatch($matchId)
    {
        try {
            $match = $this->riot->getMatch($matchId);
        } catch (\Exception $e) {
            /* throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Match not found'); */
            return null;
        }

        return $match;
    }

    public function addMatchStats($participant, $response)
    {
        // init item entity 
        $itemEntity = new ItemEntity($this->riot, $this->locale);

        // WIN OR LOSE
        $response['win'] = $participant->stats->win;
        // KDA
        $response['kda'] = $participant->stats->kills . "/" . $participant->stats->deaths . "/" . $participant->stats->assists;

        // GOLDS
        $response['gold'] = $this->thousandsCurrencyFormat($participant->stats->goldEarned);

        // KEYSTONES
        $runeEntity = new RuneEntity($this->riot, $this->locale);
        $keystones = $runeEntity->getKeystones($participant);
        $response['keystone'] = $keystones['keystone'];
        $response['subkeystone'] = $keystones['subkeystone'];

        // ITEMS
        $response['items'] = $itemEntity->getItems($participant->stats);
        // Summoner Spells
        $spellEntity = new SpellEntity($this->riot, $this->locale);
        $response['summonerSpells'] = $spellEntity->getSummonerSpells($participant);

        return $response;
    }

    public function initMatchArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'participantId' => null,
            'champion' => [],
            'date' => null,
            'player' => [],
            'win' => null,
            'kda' => null,
            'gold' => null,
            'keystone' => null,
            'subkeystone' => null,
            'items' => [],
            'summonerSpells' => [],
            'vs' => []
        ];
    }
}
