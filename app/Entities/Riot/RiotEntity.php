<?php

namespace App\Entities\Riot;

//RIOT API
use RiotAPI\LeagueAPI\LeagueAPI;
use RiotAPI\LeagueAPI\Definitions\Region;
// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class RiotEntity
{

    public $locale;
    public $dataDragonVersion = '10.10.3216176';

    public function __construct($locale)
    {
        $this->locale = $locale;
        app()->setLocale($locale);
    }

    public static $lanes = array(
        'all',
        'top',
        'mid',
        'jungle',
        'adc',
        'support'
    );

    public static function initDataDragonAPI()
    {
        DataDragonAPI::initByCdn();
    }

    public function initApi($region)
    {
        // if (empty(env('RIOT_API_KEY')))
        // 	die("Please change API key in the configuration file (.env) to your own." . env('RIOT_API_KEY'));
        $api = new LeagueAPI([
            LeagueAPI::SET_KEY              => config('app.riot_api_key'),
            LeagueAPI::SET_TOURNAMENT_KEY   => "",
            LeagueAPI::SET_REGION           => Region::$list[strtolower($region)],
            LeagueAPI::SET_VERIFY_SSL       => false,
            LeagueAPI::SET_DATADRAGON_INIT  => true,
            LeagueAPI::SET_STATICDATA_LINKING => true,
            /* LeagueAPI::SET_STATICDATA_VERSION => '10.10.3216176', */
            LeagueAPI::SET_STATICDATA_LOCALE => $this->localeMutator(),
            LeagueAPI::SET_INTERIM          => true,
            LeagueAPI::SET_CACHE_RATELIMIT  => true,
            LeagueAPI::SET_CACHE_CALLS      => true,
            LeagueAPI::SET_CACHE_CALLS_LENGTH  => [
                LeagueAPI::RESOURCE_STATICDATA => 9999,
            ]
        ]);


        return $api;
    }

    public function initApiMulti($regions)
    {
        // if (empty(env('RIOT_API_KEY')))
        // 	die("Please change API key in the configuration file (.env) to your own." . env('RIOT_API_KEY'));
        foreach ($regions as $region) {
            $api[$region] = new LeagueAPI([
                LeagueAPI::SET_KEY              => config('app.riot_api_key'),
                LeagueAPI::SET_TOURNAMENT_KEY   => "",
                LeagueAPI::SET_REGION           => Region::$list[strtolower($region)],
                LeagueAPI::SET_VERIFY_SSL       => false,
                LeagueAPI::SET_DATADRAGON_INIT  => true,
                LeagueAPI::SET_STATICDATA_LINKING => true,
                /* LeagueAPI::SET_STATICDATA_VERSION => '10.10.3216176', */
                LeagueAPI::SET_STATICDATA_LOCALE => $this->localeMutator(),
                LeagueAPI::SET_INTERIM          => true,
                LeagueAPI::SET_CACHE_RATELIMIT  => true,
                LeagueAPI::SET_CACHE_CALLS      => true,
                LeagueAPI::SET_CACHE_CALLS_LENGTH  => [
                    LeagueAPI::RESOURCE_STATICDATA => 9999,
                ]
            ]);
        }

        return $api;
    }

    public function getQueuesTypes($queues)
    {
        $queuesArray = $queues;
        self::initDataDragonAPI();
        $response = [];
        $queuesDragon = DataDragonAPI::getQueues($this->localeMutator());
        if (is_array($queuesArray)) {
            foreach ($queuesArray as $queue) {
                $response[$queue] = $this->initQueueArray();
                $response[$queue]['name'] = $queuesDragon[$queue]['name'];
                $response[$queue]['description'] = $queuesDragon[$queue]['description'];
            }
        } else {
            $response[$queuesArray] = $this->initQueueArray();
            $response[$queuesArray]['name'] = $queuesDragon[$queuesArray]['name'];
            $response[$queuesArray]['description'] = $queuesDragon[$queuesArray]['description'];
        }


        return $response;
    }

    public function initQueueArray()
    {
        return [
            'name' => null,
            'description' => null
        ];
    }

    // locale normal to locale for riot api (by territory)
    public function localeMutator()
    {

        $localesData = DataDragonAPI::getStaticLanguages();

        foreach ($localesData as $l) {
            if (strtolower(substr($l, 0, 2)) == strtolower($this->locale)) {
                return $l;
            }
        }
        if (empty($l)) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException("Can't find your locale");
        }
    }
}
