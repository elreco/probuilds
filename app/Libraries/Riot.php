<?php

namespace App\Libraries;

//RIOT API
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
use Illuminate\Foundation\Application;

class Riot
{
    public static $lanes = array(
		'all',
        'top',
        'mid',
        'jungle',
        'adc',
        'support'
	);

    public static function initApi($region){
        // if (empty(env('RIOT_API_KEY')))
        // 	die("Please change API key in the configuration file (.env) to your own." . env('RIOT_API_KEY'));
        $api = new LeagueAPI([
        	LeagueAPI::SET_KEY              => config('app.riot_api_key'),
        	LeagueAPI::SET_TOURNAMENT_KEY   => "",
        	LeagueAPI::SET_REGION           => Region::$list[strtolower($region)],
        	LeagueAPI::SET_VERIFY_SSL       => false,
        	LeagueAPI::SET_DATADRAGON_INIT  => true,
            LeagueAPI::SET_STATICDATA_LINKING => true,
        	LeagueAPI::SET_INTERIM          => true,
        	LeagueAPI::SET_CACHE_RATELIMIT  => true,
        	LeagueAPI::SET_CACHE_CALLS      => true,
            LeagueAPI::SET_CACHE_CALLS_LENGTH=> 9999
        ]);
        return $api;
    }
}
