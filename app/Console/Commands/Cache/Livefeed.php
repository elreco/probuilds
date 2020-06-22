<?php

namespace App\Console\Commands\Cache;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

use App\Entities\CacheEntity;

class Livefeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:livefeed {page} {locale} {lane} {champion?}';

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
        $request->replace([
            'page' => $this->argument('page'),
            'locale' => $this->argument('locale'),
            'lane' => $this->argument('lane'),
            'champion' => $this->argument('champion')
        ]);
        CacheEntity::useCache('LiveFeedController', $request, 'getLiveFeed', true);
    }
}
