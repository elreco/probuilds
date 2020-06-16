<?php

namespace App\Entities;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// STRING
use Illuminate\Support\Str;

use App\Entities\Riot\RiotEntity;

class ChampionEntity
{

    public function __construct()
    {
        RiotEntity::initDataDragonAPI();
    }

    /**
     * Display champion key for a given champion name.
     *
     * @return Champion key or null
     */

    public function getChampionKey($championName = null)
    {
        if (!empty($championName)) {
            $champions = DataDragonAPI::getStaticChampions();
            foreach ($champions['data'] as $champ) {
                if (strcasecmp($champ['name'], $championName) == 0) {
                    $champion = intval($champ['key']);
                }
            }
            // il n'y a pas de champion
            if (empty($champion)) {
                return null;
            } else {
                return $champion;
            }
        } else {
            return null;
        }
    }
    /**
     * Display all champions for a given champion name.
     *
     * @return Array
     */
    public function getChampionsByName($request)
    {
        $return = [];
        // init data dragon
        $champions = DataDragonAPI::getStaticChampions();
        foreach ($champions['data'] as $c) {
            if (Str::startsWith(strtoupper($c['id']), strtoupper($request->query('name'))) or Str::startsWith(strtoupper($c['name']), strtoupper($request->query('name')))) {
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

    /**
     * Check if champion exists and returns his well formatted name.
     *
     * @return boolean or string
     */
    public function checkIfChampionExists($request)
    {
        // init data dragon
        DataDragonAPI::initByCdn();
        $champions = DataDragonAPI::getStaticChampions();
        foreach ($champions['data'] as $c) {
            if (strtoupper($c['name']) == strtoupper($request->query('name'))) {
                return $c['name'];
            }
        }
        return response()->json(['message' => 'Not Found!'], 404);
    }

    /**
     * Check if champion exists and returns his well formatted name.
     *
     * @return boolean or string
     */
    public function getChampionDetails($staticData)
    {
        $response = $this->initChampionArray();

        $src = DataDragonAPI::getChampionIconO($staticData);

        // CHAMPION
        $response['title'] = $staticData->name;
        $response['src'] =  $src->src;
        $response['description'] = "<h4 class='text-gold mb-2'>{$staticData->title}</h4><p>{$staticData->lore}</p>";

        return $response;
    }

    public function initChampionArray()
    {
        return [
            'title' => null,
            'src' => null,
            'description' => null,
        ];
    }
}
