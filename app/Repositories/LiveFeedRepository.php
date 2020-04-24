<?php

namespace App\Repositories;

use App\Libraries\MatchEntity;

class LiveFeedRepository{

    public function get($request){
        return MatchLibrary::getMatchs($request)->take(5);
    }

}
