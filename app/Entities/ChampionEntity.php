<?php

namespace App\Entities;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class ChampionEntity{

    /**
     * Display champion key for a given champion name.
     *
     * @return Champion key or null
     */

    public function getChampionKey($championName = null){

        if(!empty($championName)){
            $champions = DataDragonAPI::getStaticChampions();
            foreach($champions['data'] as $champ){
                if(strcasecmp($champ['name'], $championName) == 0){
                    $champion = intval($champ['key']);
                }
            }
            // il n'y a pas de champion
            if(empty($champion)){
                return null;
            }else{
                return $champion;
            }
        }else{
            return null;
        }

    }

}
