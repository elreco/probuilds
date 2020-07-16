<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Entities\CacheEntity;


class Spectate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:spectate';

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
        $request = new Request();
        $requests = [
            'locale' => app()->getLocale(),
            'force' => env("APP_KEY"),
        ];
        $request->replace($requests);

        CacheEntity::useCache('SpectateController', $request, 'getLiveMatches');
        /* foreach (RegionEntity::$list as $region) {
            $request = new Request();
            $requests = [
                'locale' => app()->getLocale(),
                'force' => true,
                'region' => $region
            ];
            $request->replace($requests);

            CacheEntity::useCache('SpectateController', $request, 'getLiveMatches');
        } */
    }
}
