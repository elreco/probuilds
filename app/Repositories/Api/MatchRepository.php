<?php

namespace App\Repositories\Api;

// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// LIBRARIES
use App\Libraries\Riot;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class MatchRepository implements MatchRepositoryInterface
{
    public function getChallengersLastMatch(Collection $challengers, ?String $champion)
    {
        foreach($challengers as $c){

            try {
                $summoner = $this->riot->getSummoner($c->summonerId);
            } catch (\Exception $e) {
                return null;
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
                    return null;
                }
            }
            try {
                $matchs[$c->summonerId] = collect($this->riot->getMatchlistByAccount($summoner->accountId, null, null, $champion,null,null, 0, 1));
                $matchs[$c->summonerId]['summoner'] = $summoner;
            } catch (\Exception $e) {
                return null;
            }
        }
        return collect($matchs);
    }
}
