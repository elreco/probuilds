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
    protected $signature = 'cache:livefeed {lane} {champion?}';

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
        $lang = app()->getLocale();
        $championEntity = new ChampionEntity($lang);
        if (!empty($this->argument('champion')) && $this->argument('champion') == 'all') {
            // get all champions
            $champions = $championEntity->getAllChampionsID();
            foreach ($champions as $champion) {
                $this->livefeed($lang, $this->argument('lane'), $champion);
            }
        } else {
            $champion = "";
            if (!empty($this->argument('champion'))) {
                $champion = $this->argument('champion');
            }
            $this->livefeed($lang, $this->argument('lane'), $champion);
        }
    }

    public function livefeed($lang, $lane, $champion)
    {
        $request = new Request();
        $requests = [
            'locale' => $lang,
            'lane' => $lane,
            'force' => env("APP_KEY"),
        ];
        if (!empty($champion)) {
            $requests['champion'] = $champion;
        }
        $request->replace($requests);
        CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed');
    }
}
