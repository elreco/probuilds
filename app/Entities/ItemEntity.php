<?php

namespace App\Entities;

// COLLECTION
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\Riot\RiotEntity;

class ItemEntity
{
    //
    use CommonTrait;

    protected $riot;
    protected $locale = "fr";

    public function __construct($locale)
    {
        $this->locale = $locale;
        RiotEntity::initDataDragonAPI();
    }

    public function getItems($participantStats)
    {
        $itemsNumber = 6;

        $response = [];
        // ITEMS
        $riotEnitity = new RiotEntity($this->locale);
        $items = DataDragonAPI::getStaticItems($riotEnitity->localeMutator());

        for ($u = 1; $u <= $itemsNumber; $u++) {
            $item_name = "item" . $u;
            if (!empty($participantStats->$item_name)) {
                $response[$u]['src'] = DataDragonAPI::getItemIconUrl($participantStats->$item_name);
                $response[$u]['title'] = !empty($items['data'][$participantStats->$item_name]) ? $items['data'][$participantStats->$item_name]['name'] : '';
                $response[$u]['description'] = !empty($items['data'][$participantStats->$item_name]) ? $items['data'][$participantStats->$item_name]['description'] : '';
            }
        }

        return $response;
    }

    /* public function initItemArray($numbers)
    {
        for ($i = 1; $i <= $numbers; $i++) {
            $array[$i] = [

                'src' => null,
                'title' => null,
                'description' => null
            ];
        };
        return $array;
    } */
}
