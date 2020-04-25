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

        if(!empty($champion)){
            $champions = DataDragonAPI::getStaticChampions();
            foreach($champions['data'] as $champ){
                if(strcasecmp($champ['name'], $champion) == 0){
                    $champion = intval($champ['key']);
                }
            }
            // il n'y a pas de champion
            if(empty($champion)){ return null; }
        }else{
            return null;
        }

    }

}
