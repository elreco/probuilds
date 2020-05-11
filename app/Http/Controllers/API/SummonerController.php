<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//RIOT API
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class SummonerController extends Controller
{

    public $riot;

    public function __construct()
    {
        // INITALISATION DE L'API
        if (empty(env('RIOT_API_KEY')))
            die("Please change API key in the configuration file (.env) to your own.");
        $this->riot = new LeagueAPI([
            LeagueAPI::SET_KEY              => env('RIOT_API_KEY'),
            LeagueAPI::SET_TOURNAMENT_KEY   => "",
            LeagueAPI::SET_REGION           => Region::EUROPE_WEST,
            LeagueAPI::SET_VERIFY_SSL       => false,
            LeagueAPI::SET_DATADRAGON_INIT  => true,
            LeagueAPI::SET_STATICDATA_LINKING => true,
            LeagueAPI::SET_INTERIM          => true,
            LeagueAPI::SET_CACHE_RATELIMIT  => true,
            LeagueAPI::SET_CACHE_CALLS      => true,
        ]);
        DataDragonAPI::initByApi($this->riot);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $summoner = $this->riot->getSummonerByName("Leeonel Messin"); // summonerIds are unique per API key, getByName first is necessary
            $s = $this->riot->getSummoner($summoner->id);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
        }
        // // DataDragon
        $return->dragon = DataDragonAPI::getProfileIcon($id);
        dd($return);
        //

        return response()->json([
            'error' => false,
            'data'  => $return,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
