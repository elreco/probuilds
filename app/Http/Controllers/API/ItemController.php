<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Item\ShowRequest;
// ENTITY
use App\Entities\ItemEntity;
use App\Entities\Riot\RiotEntity;

class ItemController extends Controller
{


    public function show(ShowRequest $request)
    {
        $riotEntity = new RiotEntity($request->locale);
        $riot = $riotEntity->initApi($request->region);

        $itemEntity = new ItemEntity($riot, $request->locale);
        return $itemEntity->getItem($request->id);
    }
}
