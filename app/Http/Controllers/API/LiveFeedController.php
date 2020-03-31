<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// MODEL
use App\Libraries\Riot;
use App\Libraries\LiveFeed;
// REGION
use App\Libraries\Region;
// RULE
use Illuminate\Validation\Rule;
// COLLECTION
use Illuminate\Support\Collection;

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

        $itemsNumber = 5;
        $matchs = [];
        // si une region n'est pas sélectionnée
        if(empty($request->region)){
            $regions = $this->regions;
        }else{
            $regions = [$request->region];
        }

        $this->LiveFeed = new LiveFeed($regions);
        return $this->LiveFeed->getMatchs($request->lane, $request->page, $itemsNumber);
    }
}
