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
    /**
     * Display all champions for a given champion name.
     *
     * @return Array
     */
    public function getChampionsByName($request){
        $return = [];
        $i=0;
        // init data dragon
        DataDragonAPI::initByCdn();
        $champions = DataDragonAPI::getStaticChampions();
        foreach($champions['data'] as $c){
            if(empty($request->query('name')) OR Str::startsWith(strtoupper($c['id']), strtoupper($request->query('name'))) OR Str::startsWith(strtoupper($c['name']), strtoupper($request->query('name')))){
                $return[intval($c['key'])] = [
                    'id' => intval($c['key']),
                    'name' => $c['name'],
                    'title' => Str::ucfirst($c['title']),
                    'src' => DataDragonAPI::getChampionIconUrl($c['id'])
                ];
            }
        }
        return array_slice($return, 0, 5);
    }

}
