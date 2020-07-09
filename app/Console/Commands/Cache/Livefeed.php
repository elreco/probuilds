<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Entities\CacheEntity;
use App\Entities\ChampionEntity;

class Livefeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:livefeed {locale} {lane} {champion?}';

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
        $championEntity = new ChampionEntity($this->argument('locale'));

        if (!empty($this->argument('champion')) && $this->argument('champion') == 'all') {
            // get all champions
            $champions = $championEntity->getAllChampionsName();
            foreach ($champions as $champion) {
                $request = new Request();
                $requests = [
                    'locale' => $this->argument('locale'),
                    'lane' => $this->argument('lane'),
                    'force' => true
                ];
                $requests .= [
                    'champion' => $champion,
                ];
                $request->replace($requests);
                CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed');
            }
        } else {
            $request = new Request();
            $requests = [
                'locale' => $this->argument('locale'),
                'lane' => $this->argument('lane'),
                'force' => true
            ];
            if (!empty($this->argument('champion'))) {
                $requests .= [
                    'champion' => $this->argument('champion'),
                ];
            }
            $request->replace($requests);
            CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed');
        }
    }
}
