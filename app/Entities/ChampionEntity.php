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
                if ($champ['id'] ==  $championName) {
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
                    'id' => $c['id'],
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
            if ($c['id'] == $request->id) {
                return $c['name'];
            }
        }
        return false;
    }
    /**
     * Check if champion exists and returns his well formatted name.
     *
     * @return array
     */
    public function getAllChampionsID()
    {
        // init data dragon
        $response = [];
        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());
        foreach ($champions['data'] as $c) {
            $response[] = $c['id'];
        }
        return $response;
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
        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());
        // CHAMPION
        foreach ($champions['data'] as $champion) {

            if ($staticData->id == $champion['id']) {
                $response['id'] = $champion['id'];
                $response['name'] = $champion['name'];
                $response['src'] =  $src->src;
                $response['description'] = "<h4 class='text-gold mb-2'>" . Str::ucfirst($staticData->title) . "</h4><p>{$staticData->lore}</p>";
            }
        }

        return $response;
    }

    public function getChampionDetailsByName($name)
    {
        $response = $this->initChampionArray();

        $riotEntity = new RiotEntity($this->locale);
        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());

        foreach ($champions['data'] as $c) {
            if ($c['id'] == $name) {
                $response = [
                    'id' => $c['id'],
                    'name' => $c['name'],
                    'title' => Str::ucfirst($c['title']),
                    'src' => DataDragonAPI::getChampionIconUrl($c['id']),
                    'splash' => DataDragonAPI::getChampionSplashUrl($c['id']),
                    'description' => $c['blurb']
                ];
            }
        }

        if (empty($response['name'])) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Champion not found2');
        }

        return $response;
    }

    public function getChampionSpells($name)
    {
        /* $response = $this->initChampionArray(); */
        $response = [];

        $riotEntity = new RiotEntity($this->locale);

        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());

        foreach ($champions['data'] as $c) {
            if ($c['id'] == $name) {
                $champion = DataDragonAPI::getStaticChampionDetails($c['id'], $riotEntity->localeMutator());
                foreach ($champion['data'][$c['id']]['spells'] as $key => $spell) {
                    $key = $key + 1;
                    $response[$key] = $this->initChampionSpellsArray();
                    $response[$key]['id'] = $spell['id'];
                    $response[$key]['src'] = DataDragonAPI::getSpellIconUrl($spell['id'], $riotEntity->localeMutator());
                    $response[$key]['name'] = $spell['name'];
                    $response[$key]['description'] = $spell['description'];
                }
            }
        }

        if (empty($response)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Champion not found3');
        }

        return $response;
    }

    public function getChampionSpellsById($champion, $id)
    {
        /* $response = $this->initChampionArray(); */

        $response = $this->initChampionSpellsArray();

        $riotEntity = new RiotEntity($this->locale);

        $champions = DataDragonAPI::getStaticChampions($riotEntity->localeMutator());

        foreach ($champions['data'] as $c) {
            if ($c['id'] == $champion) {
                $champion = DataDragonAPI::getStaticChampionDetails($c['id'], $riotEntity->localeMutator());
                foreach ($champion['data'][$c['id']]['spells'] as $key => $spell) {
                    $key = $key + 1;
                    if ($id == $key) {
                        $response['id'] = $spell['id'];
                        $response['src'] = DataDragonAPI::getSpellIconUrl($spell['id'], $riotEntity->localeMutator());
                        $response['name'] = $spell['name'];
                        $response['description'] = $spell['description'];
                    }
                }
            }
        }

        if (empty($response)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Champion not found4');
        }

        return $response;
    }

    public function initChampionArray()
    {
        return [
            'id' => null,
            'name' => null,
            'title' => null,
            'src' => null,
            'splash' => null,
            'description' => null,
        ];
    }

    public function initChampionSpellsArray()
    {
        return [
            'id' => null,
            'name' => null,
            'src' => null,
            'description' => null
        ];
    }
}
