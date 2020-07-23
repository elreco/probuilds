<?php

namespace App\Entities\Summoner;

use App\Entities\Riot\RiotEntity;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class RuneEntity
{

    protected $riot;
    protected $locale;

    public function __construct($riot, $locale)
    {
        $this->riot = $riot;
        $this->locale = $locale;
        app()->setLocale($locale);
        RiotEntity::initDataDragonAPI();
    }

    public function getKeystones($participant)
    {
        $response = $this->initKeystonesArray();
        $runes = $this->riot->getStaticReforgedRunes()->runes;
        $rune_paths = $this->riot->getStaticReforgedRunePaths()->paths;
        $player_stats = $participant->stats;
        $response['keystone'] = !empty($runes[$player_stats->perk0]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk0])->src : '';
        $response['subkeystone'] = !empty($rune_paths[$player_stats->perkSubStyle]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$player_stats->perkSubStyle])->src : '';

        return $response;
    }

    public function getRunesIDs($participant)
    {
        $response = $this->initRunesArray();
        $riotEntity = new RiotEntity($this->locale);
        $runes = $this->riot->getStaticReforgedRunes($riotEntity->localeMutator())->runes;
        $rune_paths = $this->riot->getStaticReforgedRunePaths($riotEntity->localeMutator())->paths;
        //dd($runes);
        $player_stats = $participant->stats;

        $response['first']['principal']['id'] = $player_stats->perkPrimaryStyle;

        for ($i = 0; $i < 4; $i++) {
            $iname = "perk" . $i;
            $response['first']['rune'][$i]['id'] = $player_stats->$iname;
        }
        $response['second']['principal']['id'] = $player_stats->perkSubStyle;

        for ($i = 4; $i < 6; $i++) {
            $iname = "perk" . $i;
            $response['second']['rune'][$i]['id'] = $player_stats->$iname;
        }

        for ($i = 0; $i < 3; $i++) {
            $iname = "statPerk" . $i;
            $response['third'][$i]['id'] = $player_stats->$iname;
        }

        return $response;
    }

    public function getRunesDetails($runesJson)
    {
        $runesArray = json_decode($runesJson, true);

        $response = $this->initRunesArray();

        $riotEntity = new RiotEntity($this->locale);

        $runes = $this->riot->getStaticReforgedRunes($riotEntity->localeMutator())->runes;
        $rune_paths = $this->riot->getStaticReforgedRunePaths($riotEntity->localeMutator())->paths;
        $perks = $this->riot->getStaticPerks($riotEntity->localeMutator())->runes;

        $response['first']['principal']['name'] = !empty($rune_paths[$runesArray['first']['principal']['id']]) ? $rune_paths[$runesArray['first']['principal']['id']]->name : '';
        $response['first']['principal']['src'] = !empty($rune_paths[$runesArray['first']['principal']['id']]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$runesArray['first']['principal']['id']])->src : '';
        for ($i = 0; $i < 4; $i++) {
            $response['first']['rune'][$i] =
                [
                    'src' => !empty($runes[$runesArray['first']['rune'][$i]['id']]) ? DataDragonAPI::getReforgedRuneIconO($runes[$runesArray['first']['rune'][$i]['id']])->src : '',
                    'name' => !empty($runes[$runesArray['first']['rune'][$i]['id']]) ? $runes[$runesArray['first']['rune'][$i]['id']]->name : '',
                    'description' => !empty($runes[$runesArray['first']['rune'][$i]['id']]) ? strip_tags($runes[$runesArray['first']['rune'][$i]['id']]->shortDesc) : '',
                ];
        }
        $response['second']['principal']['name'] = !empty($rune_paths[$runesArray['second']['principal']['id']]) ? $rune_paths[$runesArray['second']['principal']['id']]->name : '';
        $response['second']['principal']['src'] = !empty($rune_paths[$runesArray['second']['principal']['id']]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$runesArray['second']['principal']['id']])->src : '';
        for ($i = 4; $i < 6; $i++) {
            $response['second']['rune'][$i] =
                [
                    'src' => !empty($runes[$runesArray['second']['rune'][$i]['id']]) ? DataDragonAPI::getReforgedRuneIconO($runes[$runesArray['second']['rune'][$i]['id']])->src : '',
                    'name' => !empty($runes[$runesArray['second']['rune'][$i]['id']]) ? $runes[$runesArray['second']['rune'][$i]['id']]->name : '',
                    'description' => !empty($runes[$runesArray['second']['rune'][$i]['id']]) ? strip_tags($runes[$runesArray['second']['rune'][$i]['id']]->shortDesc) : '',
                ];
        }

        for ($i = 0; $i < 3; $i++) {
            $perks = $this->riot->getStaticPerks($riotEntity->localeMutator())->runes;
            $response['third'][$i] =
                [
                    'src' => !empty($perks[$runesArray['third'][$i]['id']]) ? DataDragonAPI::getPerkPathIconO($perks[$runesArray['third'][$i]['id']])->src : '',
                    'name' => !empty($perks[$runesArray['third'][$i]['id']]) ? $perks[$runesArray['third'][$i]['id']]->name : '',
                    'description' => !empty($perks[$runesArray['third'][$i]['id']]) ? strip_tags($perks[$runesArray['third'][$i]['id']]->shortDesc) : '',
                ];
        }
        return $response;
    }

    public function initKeystonesArray()
    {
        return [
            'keystone' => null,
            'subkeystone' => null
        ];
    }

    public function initRuneArray()
    {
        return [
            'name' => null,
            'description' => null
        ];
    }

    public function initRunesArray()
    {
        return [
            'first' => [
                'principal' => [
                    'id' => null,
                    'src' => null,
                    'name' => null
                ],
                'rune' => [
                    0 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    1 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    2 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    3 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                ],
            ],
            'second' => [
                'principal' => [
                    'id' => null,
                    'src' => null,
                    'name' => null
                ],
                'rune' => [
                    4 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    5 => [
                        'id' => null,
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                ],
            ],
            'third' => [
                0 => [
                    'id' => null,
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
                1 => [
                    'id' => null,
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
                2 => [
                    'id' => null,
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
            ]
        ];
    }
}
