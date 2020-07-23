<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Entities\CacheEntity;
use App\Entities\ChampionEntity;
use Illuminate\Http\Request;

class LiveFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $champion;
    protected $lane;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($champion, $lane)
    {
        //
        $this->champion = $champion;
        $this->lane = $lane;
    }

    public function handle()
    {
        //
        $lang = app()->getLocale();
        $championEntity = new ChampionEntity($lang);
        if (!empty($this->champion) && $this->champion == 'all') {
            // get all champions
            $champions = $championEntity->getAllChampionsID();
            foreach ($champions as $champion) {
                $this->livefeed($lang, $this->lane, $champion);
            }
        } else {
            $champion = "";
            if (!empty($this->champion)) {
                $champion = $this->champion;
            }
            $this->livefeed($lang, $this->lane, $champion);
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
