<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// REGION
use App\Entities\RegionEntity;

class RegionController extends Controller
{
    /**
     * route : /api/regions.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $return = [];
        $i=0;
        foreach(RegionEntity::$list as $l){
            $return[] = strtoupper($l);
        }
        return $return;
    }
}
