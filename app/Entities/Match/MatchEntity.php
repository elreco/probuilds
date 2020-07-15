<?php

namespace App\Entities\Match;

// COLLECTION
use App\Http\Traits\CommonTrait;
// ENTITY
use App\Entities\Summoner\SummonerEntity;
use App\Entities\ChampionEntity;
use App\Entities\ItemEntity;
use App\Entities\Riot\RiotEntity;
use App\Entities\Summoner\SpellEntity;
use App\Entities\Summoner\RuneEntity;
use App\Entities\CacheEntity;
use Illuminate\Support\Facades\Storage;

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

    public function getMatchesTopElo($request)
    {

        // Get Challengers
        $requestChallenger = new Request();
        $requestChallenger->replace([
            'force' => false,
        ]);
        $challengers = CacheEntity::useEntityCache('Summoner\ChallengerEntity', 'getChallengers', $this->riot, $requestChallenger);
        // Get last matchs for each challenger
        $challengersLastMatch = CacheEntity::useEntityCache('Match\MatchEntity', 'getChallengersLastMatch', $this->riot, $request, $challengers);
        // return an array of matches
        $matches = $this->formatMatches($challengersLastMatch, $request);
        return $matches;
        /* return $challengersLastMatch; */
    }

    /**
     * Format the matches from riot api return.
     *
     * @return Array
     */
    public function formatMatches($matches, $request)
    {
        $i = 0;
        $lane = $request->lane;
        $response = [];
        // entities
        $championEntity = new ChampionEntity($this->locale);
        // equivalent de if !empty
        foreach ($matches as $summonerId => $m) {
            $requestMatch = new Request();
            $requestMatch->replace([
                'locale' => $this->locale,
                'id' => $m[0]->gameId,
                'force' => !empty($request->force) ? true : false,
            ]);
            $matchApi = CacheEntity::useEntityCache('Match\MatchEntity', 'getMatch', $this->riot, $requestMatch);

            /* $matchApi = $this->getMatch($request); */
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
                $response[$i]['region'] = $request->region;
                // summonerId
                $response[$i]['summonerId'] = $summonerId;
                // champion
                $response[$i]['champion'] = $championEntity->getChampionDetails($m[0]->staticData);

                // DATE
                $response[$i]['date'] = $m[0]->timestamp;

                // PLAYER
                $requestSummoner = new Request();
                $requestSummoner->replace([
                    'id' => $m['summoner']->id,
                    'force' => !empty($request->force) ? true : false,
                ]);
                $response[$i]['player'] = CacheEntity::useEntityCache('Summoner\SummonerEntity', 'getSummonerDetails', $this->riot, $requestSummoner);
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
                if (!empty($request->force)) {
                    foreach ($participantsAPI as $participant) {
                        $matchRequest = new Request();
                        $matchRequest->replace([
                            'id' => $m[0]->gameId,
                            'locale' => $this->locale,
                            'region' => $request->region,
                            'summonerId' => $participantIdentities[$participant->participantId]->player->summonerId,
                            'champion' => $participant->staticData->name,
                            'participantId' => $participant->participantId,
                            'force' => true,
                        ]);
                        CacheEntity::useCache('MatchController', $matchRequest, 'getMatchDetails');
                    }
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

    public function getChallengersLastMatch($request, $challengers)
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

    public function getMatch($request)
    {
        try {
            $match = $this->riot->getMatch($request->id);
        } catch (\Exception $e) {
            /* throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Match not found'); */
            return null;
        }
        return $match;
    }

    public function getLiveMatch($summonerId)
    {
        try {
            $match = $this->riot->getCurrentGameInfo($summonerId);
        } catch (\Exception $e) {
            /* throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Match not found'); */
            return null;
        }
        return $match;
    }

    public function addMatchStats($participant, $response)
    {
        // init item entity 
        $itemEntity = new ItemEntity($this->locale);

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
        $spellEntity = new SpellEntity($this->locale);
        $response['summonerSpells'] = $spellEntity->getSummonerSpells($participant);

        return $response;
    }

    public function getLiveMatches($request)
    {
        $response = [];
        $matches = [];

        $requestChallenger = new Request();
        $requestChallenger->replace([
            /* 'numbers' => 100, */
            'force' => false,
        ]);
        $challengers = CacheEntity::useEntityCache('Summoner\ChallengerEntity', 'getChallengers', $this->riot, $requestChallenger);

        foreach ($challengers as $c) {
            $match = $this->getLiveMatch($c->summonerId);
            if (!empty($match) && empty($matches[$match->gameId])) {
                $matches[$match->gameId] = $match;
            }
        }
        $featuredGames = $this->riot->getFeaturedGames();
        foreach ($featuredGames as $game) {
            if (empty($matches[$game->gameId])) {
                $matches[$game->gameId] = $game;
            }
        }
        /* $matches = $this->riot->getFeaturedGames(); */
        $championEntity = new ChampionEntity($this->locale);
        $i = 0;
        foreach ($matches as $match) {
            $response[$i] = $this->initLiveMatchArray();
            $response[$i]['region'] = $request->region;
            $response[$i]['matchId'] = $match->gameId;
            $response[$i]['gameMode'] = $match->gameMode;
            $response[$i]['summonerName'] = $match->participants[0]->summonerName;
            $response[$i]['champion'] = $championEntity->getChampionDetailsByName($match->participants[0]->staticData->id);
            $response[$i]['date'] = $match->gameStartTime;

            $response[$i]['url'] = Storage::url('spectate/' . $request->region . '/' . $match->gameId . '.bat');

            $this->createBatchFile($match->gameId, $match->observers->encryptionKey, $match->platformId, $request->region);

            $i++;
        }

        return $response;
    }

    public function createBatchFile($matchId, $encryptionKey, $platformId, $region)
    {
        $fileContents = "REM Generated from http://lolprofile.net.\n";
        $fileContents .= "@ECHO OFF\n";
        $fileContents .= "SETLOCAL\n";
        $fileContents .= "FOR /F \"skip=2 tokens=2,*\" %%A IN ('reg.exe query \"HKEY_CLASSES_ROOT\VirtualStore\MACHINE\SOFTWARE\Wow6432Node\Riot Games\RADS\" /v \"LocalRootFolder\"') DO set \"LocalRootFolder=%%B\solutions\lol_game_client_sln\releases\"\n";
        $fileContents .= "FOR /F \"delims=\" %%i IN ('dir \"%LocalRootFolder%\" /b /ad-h /t:c /od') DO SET ver=%%i\n";
        $fileContents .= "CD %LocalRootFolder%\%ver%\deploy\ \n";
        $fileContents .= "START \"\" \"League of Legends.exe\" \"8394\" \"LoLLauncher.exe\" \"\" \"spectator spectator." . strtolower($region) . ".lol.riotgames.com:80 " . $encryptionKey . " " . $matchId . " " . $platformId . "\" \"-UseRads\"\n";

        return Storage::put('spectate/' . $region . '/' . $matchId . '.bat', $fileContents);
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

    public function initLiveMatchArray()
    {
        return [
            'matchId' => null,
            'region' => null,
            'summonerId' => null,
            'participantId' => null,
            'gameMode' => null,
            'champion' => [],
            'date' => null,
            'url' => null
        ];
    }
}
