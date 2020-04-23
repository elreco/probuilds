<?php

namespace App\Repositories\Api;

// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class SummonerRepository implements SummonerRepositoryInterface
{
    public function getChallengersLastMatch(Collection $challengers, ?String $champion)
    {

    }
}
