<?php

namespace App\Entities;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// STRING
use Illuminate\Support\Str;

use App\Entities\Riot\RiotEntity;

class ChampionEntity
{
    protected $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
        app()->setLocale($locale);
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
            $riotEntity = new RiotEntity($this->locale);
            $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());
            foreach ($champions['data'] as $champ) {
                if ($champ['name'] ==  $championName) {
                    $champion = intval($champ['key']);
                }
            }
            // il n'y a pas de champion
            if (empty($champion)) {
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Champion not found');
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
        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());
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
        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());
        foreach ($champions['data'] as $c) {
            if ($c['name'] == $request->query('name')) {
                return $c['name'];
            }
        }
        return false;
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
        $response['description'] = "<h4 class='text-gold mb-2'>" . Str::ucfirst($staticData->title) . "</h4><p>{$staticData->lore}</p>";

        return $response;
    }

    public function getChampionDetailsByName($name)
    {
        $response = $this->initChampionArray();

        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());

        foreach ($champions['data'] as $c) {
            if ($c['name'] == $name) {
                $response = [
                    'name' => $c['name'],
                    'title' => Str::ucfirst($c['title']),
                    'src' => DataDragonAPI::getChampionIconUrl($c['id']),
                    'splash' => DataDragonAPI::getChampionSplashUrl($c['id']),
                    'description' => $c['blurb']
                ];
            }
        }

        if (empty($response['name'])) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Champion not found');
        }

        return $response;
    }

    public function initChampionArray()
    {
        return [
            'name' => null,
            'title' => null,
            'src' => null,
            'splash' => null,
            'description' => null,
        ];
    }
}
