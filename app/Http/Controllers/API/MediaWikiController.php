<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mediawiki\Api\MediawikiApi;
use Mediawiki\Api\SimpleRequest;
use Mediawiki\Api\UsageException;

class MediaWikiController extends Controller
{
    //
    public function index()
    {
        // Log in to a wiki
        $api = new MediawikiApi('https://lol.gamepedia.com/api.php');
        // Get a page
        $purgeRequest = new SimpleRequest(
            'cargoquery',
            array(
                'tables' => 'Players',
                'limit' => '5',
                'fields' => 'Players.Player, Players.SoloqueueIds',
                'where' => "Players.Player LIKE '%gosu%'"
            )
        );



        try {
            $queryResponse = $api->getRequest($purgeRequest);
        } catch (UsageException $e) {
            dd($e);
        }

        dd($queryResponse);
    }
}
