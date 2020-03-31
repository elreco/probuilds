<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// MODEL
use App\Libraries\Riot;
use App\Libraries\LiveFeed;
// REGION
use RiotAPI\LeagueAPI\Definitions\Region;
// RULE
use Illuminate\Validation\Rule;

class LiveFeedController extends Controller
{

    private $LiveFeed;
    private $regions;
    private $lanes;

    public function __construct()
    {
        $this->regions = Region::$list;
        $this->lanes = Riot::$lanes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(empty($request->region)){
            $regions = ['EUW', 'NA'];
        }else{
            $regions = [$request->region];
        }
        // $validateData = $request->validate([
        //     'page' => 'integer|max:3',
        //     'lane' =>  [
        //         'nullable',
        //         Rule::in($this->lanes)
        //     ],
        //     'region' => [
        //         'nullable',
        //         Rule::in($this->regions)
        //     ],
        // ]);
        foreach($regions as $r){
            if($r != "europe"){
                $riot = Riot::initApi($r);
                $this->LiveFeed = new LiveFeed($riot);
                $matchs[] = $this->LiveFeed->getMatchs($request->page,5,$request->lane,$r);
            }
        }
        $return['data'] = $response->forPage($pageNumber, $itemsNumber)->values();
        // total éléments
        $return['totalItems'] =  $response->count();
        // nombre d'items par page
        $return['maxItems'] =  $itemsNumber;

        return $matchs;
    }
}
