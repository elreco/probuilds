<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// MODEL
use App\Libraries\Riot;
use App\Libraries\LiveFeed;


class LiveFeedController extends Controller
{

    private $LiveFeed;

    public function __construct()
    {
        $riot = Riot::initApi();
        $this->LiveFeed = new LiveFeed($riot);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'page' => 'integer|max:3'
        ]);
        return $this->LiveFeed->getMatchs($request->page,5);
    }
}
