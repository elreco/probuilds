<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class ChampionController extends Controller
{

    public function __invoke()
    {
        $return = [];
        $i=0;
        // init data dragon
        DataDragonAPI::initByCdn();
        $champions = DataDragonAPI::getStaticChampions();

        foreach($champions['data'] as $c){
            $return[$c['name']] = [
                'name' => $c['name'],
                'title' => $c['title'],
                'src' => DataDragonAPI::getChampionIconUrl($c['name'])
            ];
        }
        return $return;
    }
}
