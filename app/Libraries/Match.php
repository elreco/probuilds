<?php

namespace App\Libraries;

use HttpException;
// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class Match
{
    //
    use CommonTrait;
    protected $riot;

    public function __construct($riot){
        // MATCH
        $this->riot = $riot;
        DataDragonAPI::initByCdn();

    }

    public function formatMatchs($matchs, ?String $lane){
        // $matchs = collection of matchs
        $response = [];
        $i=0;
        // equivalent de if !empty
        if ($matchs instanceof Collection) {
            foreach($matchs as $summonerId=>$m){
                // LANE FILTER

                if(!empty($lane)){

                    if($lane == "support"){
                        if($m{0}->role != "DUO_SUPPORT"){
                            continue;
                        }
                    }elseif($lane == "adc"){
                        if($m{0}->role != "DUO_CARRY"){
                            continue;
                        }
                    }elseif($lane == "mid"){
                        if($m{0}->lane != "MID"){
                            continue;
                        }
                    }elseif($lane == "top"){
                        if($m{0}->lane != "TOP"){
                            continue;
                        }
                    }elseif($lane == "jungle"){

                        if($m{0}->lane != "JUNGLE"){

                            continue;
                        }
                    }
                }
                // GAME ID
                $response[$i]['id'] = $m{0}->gameId;
                $src = DataDragonAPI::getChampionIconO($m{0}->staticData);
                // CHAMPION
                $response[$i]['champion'] = [
                    'title' => $m{0}->staticData->name,
                    'src' => $src->src,
                    'description' =>"<h4 class='text-gold mb-2'>{$m{0}->staticData->title}</h4><p>{$m{0}->staticData->lore}</p>"
                ];

                // DATE
                $response[$i]['date'] = $m{0}->timestamp;

                // PLAYER
                $response[$i]['player']['name'] = $m['summoner']->name;
                $response[$i]['player']['icon'] = DataDragonAPI::getProfileIconO($m['summoner'])->src;
                ////////////////////////
                /// SEARCH VS PLAYER ///
                ////////////////////////
                // MATCH FROM API
                $matchApi = $this->riot->getMatch($m{0}->gameId);

                //Identité des joueurs
                $participantIdentities = [];

                try {
                    $participantIdentitiesAPI = $matchApi->participantIdentities;
                } catch (\Exception $e) {
                    return $e->getMessage();
                }

                foreach($participantIdentitiesAPI as $participantIdentity){
                    $participantIdentities[$participantIdentity->participantId] = $participantIdentity;
                    if($summonerId == $participantIdentity->player->summonerId){
                        $playerParticipantId = $participantIdentity->participantId;
                    }
                }
                // Joueurs
                try {
                    $participantsAPI = $matchApi->participants;
                } catch (\Exception $e) {
                    return $e->getMessage();
                }

                foreach($participantsAPI as $participant){
                    // GET VS CHAMPION
                    if($participant->timeline->role == $m{0}->role){
                        // $summonerVS = $this->riot->getSummoner($participantIdentities[$participant->participantId]->player->summonerId);
                        $src = DataDragonAPI::getChampionIconO($participant->staticData);
                        $response[$i]['vs'] = [
                            'title' => $participant->staticData->name,
                            'src' => $src->src,
                            'description' =>"<h4 class='text-gold mb-2'>{$participant->staticData->title}</h4><p>{$participant->staticData->lore}</p>"
                        ];
                    }
                    // GET PLAYER
                    if($participant->participantId == $playerParticipantId){
                        // WIN OR LOSE
                        $response[$i]['win'] = $participant->stats->win;
                        // KDA
                        $response[$i]['kda'] = $participant->stats->kills."/" . $participant->stats->deaths . "/". $participant->stats->assists;

                        // GOLDS
                        $response[$i]['gold'] = $this->thousandsCurrencyFormat($participant->stats->goldEarned);

                        // KEYSTONES

                        $runes = $this->riot->getStaticReforgedRunes()->runes;
                        $rune_paths = $this->riot->getStaticReforgedRunePaths()->paths;
                        $player_stats = $participant->stats;
                        $response[$i]['keystone'] = DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk0])->src;
                        $response[$i]['subkeystone'] = DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk4])->src;

                        // SLOTS
                        $items = DataDragonAPI::getStaticItems();
                        for ($u = 1; $u <= 6; $u++) {
                            $item_name = "item" . $u;
                            if(!empty($participant->stats->$item_name)){
                                $response[$i]['slots'][$u]['src'] = DataDragonAPI::getItemIconUrl($participant->stats->$item_name);
                                $response[$i]['slots'][$u]['title'] = !empty($items['data'][$participant->stats->$item_name]) ? $items['data'][$participant->stats->$item_name]['name'] : '';
                                $response[$i]['slots'][$u]['description'] = !empty($items['data'][$participant->stats->$item_name]) ? $items['data'][$participant->stats->$item_name]['description'] : '';
                            }
                        }
                        // SPELLS
                        $spells = DataDragonAPI::getStaticSummonerSpells();

                        for ($u = 1; $u <= 2; $u++) {
                            $spell_name = "spell" . $u . "Id";

                            if(!empty($participant->$spell_name)){

                                $spell = DataDragonAPI::getStaticSummonerSpellById($participant->$spell_name);
                                $response[$i]['spells'][$u]['src'] = DataDragonAPI::getSpellIconUrl($spell['id']);
                                $response[$i]['spells'][$u]['title'] = $spell['name'];
                                $response[$i]['spells'][$u]['description'] = $spell['description'];
                            }
                        }
                    }

                }
                $i++;
            }
        }
        return $response;
    }

    public function getChallengersLastMatch(Collection $challengers, ?String $champion){

        foreach($challengers as $c){

            try {
                $summoner = $this->riot->getSummoner($c->summonerId);
            } catch (\Exception $e) {
                return $e->getMessage();
            }

            // GET CHAMPION KEY
            if(!empty($champion)){
                $champions = DataDragonAPI::getStaticChampions();
                foreach($champions['data'] as $champ){
                    if(strcasecmp($champ['name'], $champion) == 0){
                        $champion = intval($champ['key']);
                    }
                }
                // il n'y a pas de champion
                if(empty($champion)){
                    return [];
                }
            }
            try {
                $matchs[$c->summonerId] = collect($this->riot->getMatchlistByAccount($summoner->accountId, null, null, $champion,null,null, 0, 1));
                $matchs[$c->summonerId]['summoner'] = $summoner;

            } catch (\Exception $e) {
                return $e->getMessage();
            }

        }

        return collect($matchs);
    }
}
