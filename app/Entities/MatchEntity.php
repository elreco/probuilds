<?php

namespace App\Entities;

use HttpException;
// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\SummonerEntity;
use App\Entities\ChampionEntity;
use App\Entities\ChallengerEntity;

class MatchEntity
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

    public function getMatchesTopElo($request, $region)
    {

        // Get Challengers
        $challengerEntity = new ChallengerEntity($this->riot);
        $challengers = $challengerEntity->getChallengers(2);
        // Get last matchs for each challenger
        $challengersLastMatch = $this->getChallengersLastMatch($challengers, $request);
        // return an array of matches
        return $this->formatMatchesOutput($challengersLastMatch, $request, $region);
    }

    /**
     * Format the matches from riot api return.
     *
     * @return Array
     */
    private function formatMatchesOutput($matches, $request, $region)
    {
        $i = 0;
        $lane = $request->lane;
        $response = [];
        // equivalent de if !empty
        foreach ($matches as $summonerId => $m) {
            // init array
            $response[$i] = $this->initMatchArray();
            // LANE FILTER
            if (!empty($lane)) {
                if ($lane == "support") {
                    if ($m[0]->role != "DUO_SUPPORT") {
                        continue;
                    }
                } elseif ($lane == "adc") {
                    if ($m[0]->role != "DUO_CARRY") {
                        continue;
                    }
                } elseif ($lane == "mid") {
                    if ($m[0]->lane != "MID") {
                        continue;
                    }
                } elseif ($lane == "top") {
                    if ($m[0]->lane != "TOP") {
                        continue;
                    }
                } elseif ($lane == "jungle") {
                    if ($m[0]->lane != "JUNGLE") {
                        continue;
                    }
                }
            }
            // GAME ID
            $response[$i]['id'] = $m[0]->gameId;
            // region
            $response[$i]['region'] = $region;
            // summonerId
            $response[$i]['summonerId'] = $summonerId;
            $src = DataDragonAPI::getChampionIconO($m[0]->staticData);

            // CHAMPION
            $response[$i]['champion'] = [
                'title' => $m[0]->staticData->name,
                'src' => $src->src,
                'description' => "<h4 class='text-gold mb-2'>{$m[0]->staticData->title}</h4><p>{$m[0]->staticData->lore}</p>"
            ];

            // DATE
            $response[$i]['date'] = $m[0]->timestamp;

            // PLAYER
            $response[$i]['player']['name'] = $m['summoner']->name;
            $response[$i]['player']['icon'] = DataDragonAPI::getProfileIconO($m['summoner'])->src;
            ////////////////////////
            /// SEARCH VS PLAYER ///
            ////////////////////////
            // MATCH FROM API
            try {
                $matchApi = $this->riot->getMatch($m[0]->gameId);
            } catch (\Exception $e) {
                return null;
            }

            //Identité des joueurs
            $participantIdentities = [];

            try {
                $participantIdentitiesAPI = $matchApi->participantIdentities;
            } catch (\Exception $e) {
                return null;
            }

            foreach ($participantIdentitiesAPI as $participantIdentity) {
                $participantIdentities[$participantIdentity->participantId] = $participantIdentity;
                if ($summonerId == $participantIdentity->player->summonerId) {
                    $playerParticipantId = $participantIdentity->participantId;
                }
            }

            // Joueurs
            try {
                $participantsAPI = $matchApi->participants;
            } catch (\Exception $e) {
                return null;
            }

            foreach ($participantsAPI as $participant) {
                // GET PLAYER
                if ($participant->participantId == $playerParticipantId) {
                    $playerParticipant = $participant;
                    // WIN OR LOSE
                    $response[$i]['win'] = $participant->stats->win;
                    // KDA
                    $response[$i]['kda'] = $participant->stats->kills . "/" . $participant->stats->deaths . "/" . $participant->stats->assists;

                    // GOLDS
                    $response[$i]['gold'] = $this->thousandsCurrencyFormat($participant->stats->goldEarned);

                    // KEYSTONES

                    $runes = $this->riot->getStaticReforgedRunes()->runes;
                    /* $rune_paths = $this->riot->getStaticReforgedRunePaths()->paths; */
                    $player_stats = $participant->stats;
                    $response[$i]['keystone'] = !empty($runes[$player_stats->perk0]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk0])->src : '';
                    $response[$i]['subkeystone'] = !empty($runes[$player_stats->perk4]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk4])->src : '';

                    // SLOTS
                    $items = DataDragonAPI::getStaticItems();
                    for ($u = 1; $u <= 6; $u++) {
                        $item_name = "item" . $u;
                        if (!empty($participant->stats->$item_name)) {
                            $response[$i]['slots'][$u]['src'] = DataDragonAPI::getItemIconUrl($participant->stats->$item_name);
                            $response[$i]['slots'][$u]['title'] = !empty($items['data'][$participant->stats->$item_name]) ? $items['data'][$participant->stats->$item_name]['name'] : '';
                            $response[$i]['slots'][$u]['description'] = !empty($items['data'][$participant->stats->$item_name]) ? $items['data'][$participant->stats->$item_name]['description'] : '';
                        }
                    }
                    // SPELLS
                    $spells = DataDragonAPI::getStaticSummonerSpells();

                    for ($u = 1; $u <= 2; $u++) {
                        $spell_name = "spell" . $u . "Id";

                        if (!empty($participant->$spell_name)) {
                            $spell = DataDragonAPI::getStaticSummonerSpellById($participant->$spell_name);
                            $response[$i]['spells'][$u]['src'] = DataDragonAPI::getSpellIconUrl($spell['id']);
                            $response[$i]['spells'][$u]['title'] = $spell['name'];
                            $response[$i]['spells'][$u]['description'] = $spell['description'];
                        }
                    }
                }
            }
            //https://riot-api-libraries.readthedocs.io/en/latest/roleid.html#a-simple-mapping
            // position REF
            $positionRef = $this->getRiotPosition($m[0]->lane, $m[0]->role);
            foreach ($participantsAPI as $participant) {
                // GET VS CHAMPION
                $participantPosition = $this->getRiotPosition($participant->timeline->lane, $participant->timeline->role);
                if (
                    $playerParticipantId != $participant->participantId
                    &&  $playerParticipant->teamId != $participant->teamId
                    && $positionRef == $participantPosition
                ) {
                    // $summonerVS = $this->riot->getSummoner($participantIdentities[$participant->participantId]->player->summonerId);
                    $src = DataDragonAPI::getChampionIconO($participant->staticData);
                    $response[$i]['vs'] = [
                        'title' => $participant->staticData->name,
                        'src' => $src->src,
                        'description' => "<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
                    ];
                }
            }


            $i++;
        }

        // Return formated matchs
        return $response;
    }

    private function getRiotPosition($laneFilter, $roleFilter)
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

    private function initMatchArray()
    {
        return [
            'id' => null,
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
    /**
     * Display a collection of last match for each challengers.
     *
     * @return \Illuminate\Support\Collection
     */

    public function getChallengersLastMatch(?Collection $challengers, $request)
    {
        $matches = [];
        if (!$challengers->isEmpty()) {
            foreach ($challengers as $c) {
                $summonerEntity = new SummonerEntity($this->riot);
                $summoner = $summonerEntity->getSummoner($c->summonerId);
                // get account Id
                !empty($summoner) ? $accountId = $summoner->accountId : null;

                // GET CHAMPION KEY
                $championEntity = new ChampionEntity();
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
}
