<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// REGION
use App\Libraries\Region;

class RegionController extends Controller
{

    public function __invoke()
    {
        $return = [];
        $i=0;
        foreach(Region::$list as $l){
            $return[] = strtoupper($l);
        }
        return $return;
    }
}
