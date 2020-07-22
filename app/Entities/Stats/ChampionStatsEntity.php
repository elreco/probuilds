<?php

namespace App\Entities\Stats;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

use App\Entities\Riot\RiotEntity;

class ChampionStatsEntity
{
    protected $locale;

    public function __construct($riot, $locale)
    {
        $this->riot = $riot;
        $this->locale = $locale;
        app()->setLocale($locale);
        RiotEntity::initDataDragonAPI();
    }
}
