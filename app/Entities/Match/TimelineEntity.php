<?php

namespace App\Entities\Match;

// COLLECTION
use App\Http\Traits\CommonTrait;
// ENTITY
use App\Entities\Riot\RiotEntity;
use App\Entities\ItemEntity;

use Carbon\Carbon;

class TimelineEntity
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

    public function getMatchTimeline($matchId)
    {
        $frames = [];
        // ITEMS
        $frames = $this->riot->getMatchTimeline($matchId);

        return $frames;
    }

    public function getItemsTimeline($frames, $participantId)
    {
        $i = 0;
        $response = [];

        $itemEntity = new ItemEntity($this->riot, $this->locale);

        foreach ($frames as $frame) {
            $response[$i] = $this->initItemsTimelineArray();
            $response[$i]['time'] = Carbon::createFromTimestampMs($frame->timestamp)->format('i:s');
            $i2 = 0;
            foreach ($frame->events as $event) {
                if ($event->participantId == $participantId && ($event->type == "ITEM_PURCHASED" or $event->type == "ITEM_SOLD")) {
                    $response[$i]['items'][$i2] = $itemEntity->getItem($event->itemId);
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

    public function getSpells($frames, $participantId)
    {
        $i = 0;
        $response = [];

        $itemEntity = new ItemEntity($this->riot, $this->locale);
        foreach ($frames as $frame) {
            $response[$i] = $this->initItemsTimelineArray();
            $response[$i]['time'] = Carbon::createFromTimestampMs($frame->timestamp)->format('i:s');
            $i2 = 0;
            foreach ($frame->events as $event) {
                if ($event->participantId == $participantId && ($event->type == "SKILL_LEVEL_UP")) {
                    dd($event);
                    $response[$i]['items'][$i2] = $itemEntity->getItem($event->itemId);
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

    public function initItemsTimelineArray()
    {
        $array = [
            'time' => null,
            'items' => [],
        ];
        return $array;
    }
}
