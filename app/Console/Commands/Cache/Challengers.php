<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Entities\CacheEntity;
use App\Entities\RegionEntity;
use App\Entities\Riot\RiotEntity;

class Challengers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:challengers {numbers?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache for task schedule';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        foreach (RegionEntity::$list as $region) {
            $riotEntity = new RiotEntity(app()->getLocale());
            $riot = $riotEntity->initApi($region);

            $requestChallenger = new Request();
            $requests['region'] = $region;
            $requests['force'] = env("APP_KEY");
            if (!empty($this->argument("numbers"))) {
                $requests['numbers'] = $this->argument("numbers");
            }
            $requestChallenger->replace($requests);
            CacheEntity::useEntityCache('Summoner\ChallengerEntity', 'getChallengers', $riot, $requestChallenger);
        }
    }
}
