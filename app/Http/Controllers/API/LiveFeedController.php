<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// COLLECTION
use Illuminate\Support\Collection;
// REPOSITORY
use App\Repositories\LiveFeedRepository;
// REQUEST
use App\Http\Requests\LiveFeed;

class LiveFeedController extends Controller
{

    private $liveFeedRepository;

    public function __construct(LiveFeedRepository $liveFeedRepository)
    {
        $this->liveFeedRepository = $liveFeedRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LiveFeed $request)
    {
        return $this->liveFeedRepository->get($request);
    }
}
