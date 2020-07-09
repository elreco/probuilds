<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Entities\CacheEntity;
use App\Entities\RegionEntity;

class Spectate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:spectate {locale}';

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
            $request = new Request();
            $requests = [
                'locale' => $this->argument('locale'),
                'force' => true,
                'region' => $region
            ];
            $request->replace($requests);

            CacheEntity::useCache('SpectateController', $request, 'getLiveMatches');
        }
    }
}
