<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// MODEL
use App\Libraries\Riot;
// REGION
use RiotAPI\LeagueAPI\Definitions\Region;

class RegionController extends Controller
{

    public function __invoke()
    {
        $return = [];
        $i=0;
        foreach(Region::$list as $l){
            if($l != "europe"){
                $return[] = strtoupper($l);
            }
        }
        return $return;
    }
}
