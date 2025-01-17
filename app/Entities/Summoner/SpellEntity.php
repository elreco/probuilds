<?php

namespace App\Entities\Summoner;

// COLLECTION
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\Riot\RiotEntity;

class SpellEntity
{
    //
    use CommonTrait;

    protected $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
        app()->setLocale($locale);
        RiotEntity::initDataDragonAPI();
    }

    public function getSummonerSpells($participant)
    {
        $response = $this->initSummonerSpellsArray();

        $riotEntity = new RiotEntity($this->locale);

        for ($u = 1; $u <= 2; $u++) {
            $spell_name = "spell" . $u . "Id";

            if (!empty($participant->$spell_name)) {
                $spell = DataDragonAPI::getStaticSummonerSpellById($participant->$spell_name, $riotEntity->localeMutator());
                $response[$u]['id'] = $spell['key'];
                $response[$u]['src'] = DataDragonAPI::getSpellIconUrl($spell['id']);
            }
        }

        return $response;
    }

    public function getSummonerSpell($id)
    {
        $response = $this->initSpellArray();

        $riotEntity = new RiotEntity($this->locale);

        $spell = DataDragonAPI::getStaticSummonerSpellById($id, $riotEntity->localeMutator());
        $response['src'] = DataDragonAPI::getSpellIconUrl($spell['id']);
        $response['name'] = $spell['name'];
        $response['description'] = $spell['description'];

        return $response;
    }



    public function initSummonerSpellsArray()
    {
        return [
            1 => [
                'id' => null,
                'src' => null,
                'name' => null,
                'description' => null
            ],
            2 => [
                'id' => null,
                'src' => null,
                'name' => null,
                'description' => null
            ]
        ];
    }
    public function initSpellArray()
    {
        return [
            'src' => null,
            'name' => null,
            'description' => null
        ];
    }
}
