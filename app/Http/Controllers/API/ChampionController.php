<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
// STRING
use Illuminate\Support\Str;

class ChampionController extends Controller
{

    /**
     * route : /api/champions.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $return = [];
        $i=0;
        // init data dragon
        DataDragonAPI::initByCdn();
        $champions = DataDragonAPI::getStaticChampions();
        foreach($champions['data'] as $c){
            if(empty($request->query('name')) OR Str::startsWith(strtoupper($c['id']), strtoupper($request->query('name'))) OR Str::startsWith(strtoupper($c['name']), strtoupper($request->query('name')))){
                $return[intval($c['key'])] = [
                    'id' => intval($c['key']),
                    'name' => $c['name'],
                    'title' => Str::ucfirst($c['title']),
                    'src' => DataDragonAPI::getChampionIconUrl($c['id'])
                ];
            }
        }
        return array_slice($return, 0, 5);
    }
}
