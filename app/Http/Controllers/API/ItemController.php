<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
// REQUEST
use App\Http\Requests\Item\ShowRequest;
// ENTITY
use App\Entities\ItemEntity;

class ItemController extends Controller
{


    public function show(ShowRequest $request)
    {
        $itemEntity = new ItemEntity($request->locale);
        return $itemEntity->getItem($request->id);
    }
}
