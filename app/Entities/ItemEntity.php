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

    protected $locale;

    public function __construct($locale)
    {
        $this->locale = $locale;
        app()->setLocale($locale);
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

    public function getItem($itemId)
    {
        $response = $this->initItemArray();

        $riotEnitity = new RiotEntity($this->locale);
        $items = DataDragonAPI::getStaticItems($riotEnitity->localeMutator());

        $response['src'] = DataDragonAPI::getItemIconUrl($itemId);
        $response['title'] = !empty($items['data'][$itemId]) ? $items['data'][$itemId]['name'] : '';
        $response['description'] = !empty($items['data'][$itemId]) ? $items['data'][$itemId]['description'] : '';

        return $response;
    }

    public function initItemArray()
    {
        $array = [
            'src' => null,
            'title' => null,
            'description' => null,
            'time' => null,
            'type' => null
        ];
        return $array;
    }
}
