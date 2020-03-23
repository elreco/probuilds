<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//RIOT API
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;
use HttpException;
// COLLECTION
use Illuminate\Support\Collection;
use App\Http\Traits\CommonTrait;
// CARBON
use Carbon\Carbon;

class LiveFeedController extends Controller
{
    use CommonTrait;

    public $riot;

    public function __construct(){
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
            LeagueAPI::SET_CACHE_CALLS_LENGTH=> 9999
        ]);
        DataDragonAPI::initByVersion("10.4.1");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // GET CHALLENGERS
        try {
            $league = collect($this->riot->getLeagueChallenger("RANKED_SOLO_5x5"))->slice(3, 3);
        } catch (\Exception $e) {
            return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
        }
        // GET CHALLENGERS
        foreach($league as $l){
            try {
                $summoner = $this->riot->getSummoner($l->summonerId);
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }

            try {
                $matchs[$l->summonerId] = collect($this->riot->getMatchlistByAccount($summoner->accountId, null, null, null,null,null, 0, 1));
                $matchs[$l->summonerId]['summoner'] = $summoner;
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }
        }

        return $this->formatMatchs(collect($matchs));
    }

    private function formatMatchs($matchs){
        $response = [];
        $i=0;
        foreach($matchs as $summonerId=>$m){

            // GAME ID
            $response[$i]['id'] = $m{0}->gameId;

            // CHAMPION
            $response[$i]['champion'] = [
                'title' => $m{0}->staticData->name,
                'src' => DataDragonAPI::getChampionIconUrl($m{0}->staticData->name),
                'description' =>"<h3>{$m{0}->staticData->title}</h3><p>{$m{0}->staticData->lore}</p>"
            ];

            // DATE
            $response[$i]['date'] = $m{0}->timestamp;

            // PLAYER
            $response[$i]['player']['name'] = $m['summoner']->name;
            $response[$i]['player']['icon'] = DataDragonAPI::getProfileIconO($m['summoner'])->src;

            ////////////////////////
            /// SEARCH VS PLAYER ///
            ////////////////////////

            //Identité des joueurs
            $participantIdentities = [];

            try {
                $participantIdentitiesAPI = $this->riot->getMatch($m{0}->gameId)->participantIdentities;
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }

            foreach($participantIdentitiesAPI as $participantIdentity){
                $participantIdentities[$participantIdentity->participantId] = $participantIdentity;
                if($summonerId == $participantIdentity->player->summonerId){
                    $playerParticipantId = $participantIdentity->participantId;
                }
            }

            // Joueurs
            try {
                $participantsAPI = $this->riot->getMatch($m{0}->gameId)->participants;
            } catch (\Exception $e) {
                return response()->json([ 'code' => $e->getCode(), 'message' => $e->getMessage()], $e->getCode());
            }

            foreach($participantsAPI as $participant){
                // GET VS CHAMPION
                if($participant->timeline->role == $m{0}->role){
                    // $summonerVS = $this->riot->getSummoner($participantIdentities[$participant->participantId]->player->summonerId);
                    $response[$i]['vs'] = [
                        'title' => $participant->staticData->name,
                        'src' => DataDragonAPI::getChampionIconUrl($participant->staticData->name),
                        'description' =>"<h3>{$participant->staticData->title}</h3><p>{$participant->staticData->lore}</p>"
                    ];
                }
                // GET PLAYER
                if($participant->participantId == $playerParticipantId){
                    // KDA
                    $response[$i]['kda'] = $participant->stats->kills."/" . $participant->stats->deaths . "/". $participant->stats->assists;

                    // GOLDS
                    $response[$i]['gold'] = $this->thousandsCurrencyFormat($participant->stats->goldEarned);

                    // KEYSTONES

                    $runes = $this->riot->getStaticReforgedRunes()->runes;
                    $rune_paths = $this->riot->getStaticReforgedRunePaths()->paths;
                    $player_stats = $participant->stats;
                    $response[$i]['keystone'] = DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk0])->src;
                    $response[$i]['subkeystone'] = DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk4])->src;

                    // SLOTS
                    $items = DataDragonAPI::getStaticItems();
                    for ($u = 1; $u <= 6; $u++) {
                        $item_name = "item" . $u;
                        if(!empty($participant->stats->$item_name)){
                            $response[$i]['slots'][$u]['src'] = DataDragonAPI::getItemIconUrl($participant->stats->$item_name);
                            $response[$i]['slots'][$u]['title'] = $items['data'][$participant->stats->$item_name]['name'];
                            $response[$i]['slots'][$u]['description'] = $items['data'][$participant->stats->$item_name]['name'];
                        }
                    }
                    // SPELLS
                    $spells = DataDragonAPI::getStaticSummonerSpells();

                    for ($u = 1; $u <= 2; $u++) {
                        $spell_name = "spell" . $u . "Id";

                        if(!empty($participant->$spell_name)){
                            $spell = DataDragonAPI::getStaticSummonerSpellById($participant->$spell_name);
                            $response[$i]['spells'][$u]['src'] = DataDragonAPI::getSpellIconUrl("Summoner" . $spell['name']);
                            $response[$i]['spells'][$u]['title'] = $spell['name'];
                            $response[$i]['spells'][$u]['description'] = $spell['description'];
                        }
                    }
                }

            }
            $i++;
        }

        return response()->json($response, 200);
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
