<?php

namespace App\Entities;

// COLLECTION
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// ENTITY
use App\Entities\Riot\RiotEntity;

use Carbon\Carbon;

class ItemEntity
{
    //
    use CommonTrait;

    protected $riot;
    protected $locale;

    public function __construct($riot, $locale)
    {
        $this->locale = $locale;
        $this->riot = $riot;
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

    public function getTimeline($request)
    {
        $response = [];
        // ITEMS
        $frames = $this->riot->getMatchTimeline($request->id);

        $i = 0;
        foreach ($frames as $frame) {
            $response[$i] = $this->initTimelineArray();
            $response[$i]['time'] = Carbon::createFromTimestampMs($frame->timestamp)->format('i:s');
            $i2 = 0;
            foreach ($frame->events as $event) {
                if ($event->participantId == $request->participantId && ($event->type == "ITEM_PURCHASED" or $event->type == "ITEM_SOLD")) {
                    $response[$i]['items'][$i2] = $this->getItem($event->itemId);
                    $response[$i]['items'][$i2]['time'] = Carbon::createFromTimestampMs($event->timestamp)->format('i:s');
                    $response[$i]['items'][$i2]['type'] = $event->type;
                    $i2++;
                }
            }
            if (empty($response[$i]['items'])) {
                unset($response[$i]);
            } else {
                $i++;
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

    public function initTimelineArray()
    {
        $array = [
            'time' => null,
            'items' => [],
        ];
        return $array;
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
